<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;
use DB;
use Illuminate\Support\Collection;
use App\Role;
use App\User;
use App\Admin_right;
use App\Http\Requests\AdminUserRequest;
use \Illuminate\Support\Facades\Auth;
use App\General_setting;
use App\Country;
use App\State;
use Illuminate\Support\Facades\Config;

class SettingController extends AdminController
{
     /**
     * Data for Admin user table.
     *
     * @param  array  $data
     * @return void
     */
    public function index()
    {
        $mode = 'create';
        $results= User::whereHas('roles', function($q){
              $q->where('name', '!=', Config::get('constants.REGULAR_USER'));
        })->get();

        $data = new Collection;

        foreach($results as $res)
        {
             $data->push([
                'id'       => $res->id,
                'name'     => $res->name,
                'email'    => $res->email,
                'role'     => $res->roles[0]->name
             ]);
        }
       return View('admin.settings.index_account', compact('data','mode'));
    }
    /**
     * Create form
     * @return type
     */
    public function getCreate()
    {
        $roles_type = Role::lists('name','id');         
        $admin_rights = Admin_right::all();
        $mode = 'create';
        
        return View('admin.settings.account_create_edit',compact('roles_type','admin_rights','mode'));
    }
    /**
     * Create admin
     * @param Request $request
     * @return type
     */
    public function postCreate(Request $request)
    {        
        $this->validate($request, [
              'name'=>'required',
              'email'=>'required|email|unique:users,email',
              'password' => 'required|alphaNum|min:6|same:cpassword',
              'cpassword' =>'required'
          ]);
        
        $user = new User;
        $newUser = $user->create($request->except('password','role'));
        $newUser->password = bcrypt($request->get('password'));
      
        
        $newUser->roles()->attach($request->get('role'));
        
        if($request->get('limit_access'))
              $newUser->limit_access = $request->get('limit_access');
          else
              $newUser->limit_access = 0;
        
        if($request->get('limit_access'))
            $newUser->admin_rights()->attach($request->get('permissions'));
          
        $newUser->save();
        
        return redirect('admin/accounts')->with('status', 'success')->with('message', 'Successfully created!');
          
    }
    /**
     * Delete admin
     * @param Request $request
     * @return type
     */
    public function postDelete(Request $request)
    {        
        if(User::where('id', $request->input('value'))->delete())
            return response()->json(['status' => 'success']);
          else
            return response()->json(['status' => 'error']); 
    }
    
    public function getEdit($id)
    {
        $mode ='edit';
        $roles_type = Role::lists('name','id');       
        $user = User::find($id);       
        $admin_rights_selected = $user->admin_rights()->lists('id')->toArray();       
        $admin_rights = Admin_right::all();
        $selected_role = $user->roles[0]->id;
        
        return View('admin/settings/account_create_edit',  compact('user','roles_type','selected_role','admin_rights','admin_rights_selected','mode'));
    }
    /**
     * Update admin data
     * @param type $id
     * @param Request $request
     * @return type
     */
    public function postUpdate($id, Request $request)
    {                
        $this->validate($request, [         
                'name'=>'required',
                'email'=>'required|email|unique:users,email,'.$id,
                'password' => 'sometimes|alphaNum|min:6|same:cpassword'         
       ]);        
                 
        $user = User::find($id);
        $user->update($request->except('password','role','limit_access'));
        
        if($request->get('password'))
            $user->password = bcrypt($request->get('password'));
       
        if($request->get('limit_access'))
            $user->limit_access = $request->get('limit_access');
            else
                 $user->limit_access = 0;
        
        $user->roles()->sync([$request->get('role')]);
            
        if($request->get('limit_access'))
            $user->admin_rights()->sync(($request->get('permissions'))?$request->get('permissions'):[]);
          else
            $user->admin_rights()->sync([]);
          
        $user->save();
        
        return redirect('admin/accounts')->with('status', 'success')->with('message', 'Successfully updated!');
    }
    /**
     * Index form for generall settings
     * @return type
     */
    public function indexGeneral()
    {   
        $serialized_data = General_setting::first();
        $countries = Country::lists('name', 'country_id');
        $state = State::lists('state', 'id');
       
        if( isset($serialized_data->settings))
            $data = unserialize($serialized_data->settings);
            else
                $data=[];
            

        return View('admin/settings/index_general_settings',compact('data', 'countries','state'));
    }
    /**
     * Update general settings
     * @param Request $request
     * @return type
     */
    public function postUpdateGeneral(Request $request)
    {    
         $this->validate($request, [
             'name'=>'required',
             'homepage_title'=>'required',
             'home_page_meta_description'=>'required',
             'account_email'=>'email|required',
             'customer_email'=>'email|required',
             'legal_name_of_bussines'=>'required',
             'phone'=>'required',
             'postal'=>'required',
             'city'=>'required',
             'street'=>'required',
                
         ]);
         
        $gen = General_setting::firstOrNew(array('id' => 1));
        $gen->settings = serialize($request->only(['name', 'homepage_title','home_page_meta_description','account_email','customer_email','legal_name_of_bussines','phone','postal','city','street','country','state']));
        $gen->save();
        
        return redirect('admin/settings/general')->with('status', 'success')->with('message', 'Successfully updated!');
    }

    /* Export START */

    public function export($type){

        $data= User::whereHas('roles', function($q){
            $q->where('name', '!=', 'Regular User');
        })->select("users.id", "users.name", "users.email", 'users.created_at')
            ->get();

        if(count($data) > 0){
            $counter = 1;
            foreach($data as $d){
                $d->id = $counter;
                $created_date = date( 'F j, Y', strtotime($d->created_at));
                $d->created_date = $created_date;
                unset($d->created_at);
                $counter++;
            }
        }

        $settings_data['data'] = $data;
        $settings_data['title'] = 'Account list';
        $settings_data['description'] = 'List of Accounts';
        $settings_data['columns'] = array('No', 'Name', 'Email', 'Date Added');

        if($type == "csv"){
            $this->export_to_csv($settings_data);
        }else if($type == "json"){
            return $this->export_to_json($data);
        }else if($type == "pdf"){
            $settings_data['columns_width'] = array('A'  =>  3,
                'B'     =>  20,
                'C'     =>  20,
                'D'     =>  20);
            $this->export_to_pdf($settings_data);
        }

        return;
    }

    /* Export END */
}