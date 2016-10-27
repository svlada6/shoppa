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
use \Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class CustomerController extends AdminController
{

     /**
     * Data for Customer table.
     *
     * @param  array  $data
     * @return void
     */
    public function index()
    {
        $results= User::whereHas('roles', function($q){
              $q->where('name', '=', Config::get('constants.REGULAR_USER'));
        })->get();

        $data = new Collection;

        foreach($results as $res)
        {
             $data->push([
                'id'       => $res->id,
                'name'       => $res->name,
                'email'       => $res->email,
                'role'       => $res->roles[0]->name
             ]);
        }

       return View('admin.customers.index', compact('data'));
    }
    /**
     * Create form
     * @return type
     */
    public function getCreate()
    {
        $mode = 'create';
        $roles_type = Role::where('name',Config::get('constants.REGULAR_USER'))->lists('name','id');   
      
        $admin_rights = Admin_right::all();
        
        return View('admin.customers.customer_create_edit',compact('roles_type','admin_rights','mode'));
    }

    /**
     * Procces data from create form
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
        $newUser->save();
        
        return redirect('admin/customers')->with('status', 'success')->with('message', 'Successfully created!');
        
     
    }
    /**
     * Delete customer
     * @param Request $request
     * @return type
     */
    public function postDelete(Request $request)
    {
         
        if(User::where('id', $request->input('value'))->delete())
        {

        return response()->json(['status' => 'success']);
        }
        else
        {
            return response()->json(['status' => 'error']);
        }
    }
    /**
     * Form for edit customer
     * @param type $id
     * @return type
     */
    public function getEdit($id)
    {
        $mode = 'edit';
        
        $roles_type = Role::where('name', Config::get('constants.REGULAR_USER'))->lists('name','id');
        
        $user = User::findOrFail($id);
        
        $admin_rights_selected = $user->admin_rights()->lists('id')->toArray();
        
        $admin_rights = Admin_right::all();

        $selected_role = $user->roles[0]->id;
        
        return View('admin/customers/customer_create_edit',  compact('user','roles_type','selected_role','admin_rights','admin_rights_selected','mode'));
    }
    /**
     *Update current customer
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
     
        $user->roles()->sync([$request->get('role')]);                  
        $user->save();
        
        return redirect('admin/customers')->with('status', 'success')->with('message', 'Successfully updated!');
    }

    /* Export START */

    public function export($type){

        $results= User::whereHas('roles', function($q){
            $q->where('name', '=', Config::get('constants.REGULAR_USER'));
        })->get();
        $data = new Collection;
        $counter = 1;
        foreach($results as $res)
        {
            $data->push([
                'id'       => $counter,
                'name'       => $res->name,
                'email'       => $res->email,
                'role'       => $res->roles[0]->name
            ]);
            $counter++;
        }

        $customer_data['data'] = $data;
        $customer_data['title'] = 'Customer list';
        $customer_data['description'] = 'List of Customers';
        $customer_data['columns'] = array('No', 'Name', 'Email', 'Role');

        if($type == "csv"){
            $this->export_to_csv($customer_data);
        }else if($type == "json"){
            return $this->export_to_json($data);
        }else if($type == "pdf"){
            $customer_data['columns_width'] = array('A'     =>  3,
                'B'     =>  20,
                'C'     =>  20,
                'D'     =>  20);
            $this->export_to_pdf($customer_data);
        }

        return;
    }

    /* Export END */

}