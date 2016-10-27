<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;
use App\Testemonial;
use DB;
use App\Faq;
use App\FaqCategory;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class TestemonialController extends AdminController
{

    /**
     * Show the form for creating new resource.
     *
     * @param  array  $data
     * @return void
     */
    public function index()
    {
        $data = DB::table('testemonials')
                ->orderBy('order', 'asc')
                ->get();

        return view( 'admin.testemonial.testemonial_index', compact('data') );
    }


    /**
     * Show the form for creating new resource.
     *
     * @return void
     */
    public function getCreate()
    {
        $mode = 'create';
        $enable_type = ['1'=>'enabled','0'=>'disabled'];
        
        return view( 'admin.testemonial.testemonial_create_edit', compact('mode','enable_type'));
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function postCreate(Request $request)
    {
        $this->validate($request, [
            'name'              => 'required|min:3|max:255',
            'body'              => 'required',
            'enable'              => 'required',
	     
	    ]);
         
        $order =  DB::table('testemonials')->max('order');
   
	    Testemonial::create([
            'name'              => $request->input('name'),
            'body'              => $request->input('body'),
            'enabled'   => $request->input('enable'),
            'order'    => $order +1
        ]);

        // redirect
        return redirect('admin/testemonials')->with('status', 'success')->with('message', 'Successfully created!');
    }


    /**
     * Show the form for edit existing resource.
     *
     * @return void
     */
    public function getEdit( $id )
    {
        $data = Testemonial::find($id);
        $mode = 'edit';
        
        $enable_type = ['1'=>'enabled','0'=>'disabled'];
    
        if( $data )
            return view( 'admin.testemonial.testemonial_create_edit', compact('data','mode','enable_type'));
        else
            return redirect('admin/testemonial')->with('status', 'error')->with('message', 'Resource Not Found!');

        
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function postEdit(Request $request, $id)
    {

        $data = Testemonial::find($id);

        if( $data )
        {
            $this->validate($request, [
                'name'              => 'required|min:3|max:255',
                'body'              => 'required',
                'enable'   => 'required',
            ]);

            $update = [
                'name'              => $request->input('name'),
                'body'              => $request->input('body'),
                'enabled'   => $request->input('enable'),
            ];

           Testemonial::where('id', $id)->update($update);

            return redirect('admin/testemonials')->with('status', 'success')->with('message', 'Successfully updated');

        }
        else
        {
            return redirect('admin/testemonials')->with('status', 'error')->with('message', 'Error while editing the resource!');;
        }

    }


    /**
     * Updates enabled/disabled row in a table.
     *
     * @param  array  $data
     * @param  array  $request
     * @return data
     */
    public function postUpdate(Request $request)
    {
        $id =  (int)str_replace('item-', '', $request->input('id'));
        
        $data = Testemonial::find($id);

        if( $data)
        {
            $this->validate($request, [
                'value' => 'required',
            ]);

            $update = [
                'enabled' => $request->input('value')
            ];

           Testemonial::where('id', $id)->update($update);

            return response()->json(['status' => 'success']);
        }
        else
        {
            return response()->json(['status' => 'error']);
        }
    }



    /**
     * Updates enabled/disabled row in a table.
     *
     * @param  array  $data
     * @param  array  $request
     * @return data
     */
    public function postDelete(Request $request)
    {
        $id =  (int)str_replace('item-', '', $request->input('id'));
    
        $data = Testemonial::find($id);
        
        
        if( $data )
        {
            $this->validate($request, [
                'id' => 'required',
            ]);

            Testemonial::where('id', $id)->delete();

            return response()->json(['status' => 'success']);
        }
        else
        {
            return response()->json(['status' => 'error']);
        }
    }

    /* Export START */

    public function export($type)
    {
        $data = Testemonial::select(DB::raw('testemonials.name AS name'),DB::raw('testemonials.body AS body'), DB::raw('testemonials.body AS body'))->get();

        $test_data['data'] = $data;
        $test_data['title'] = 'Testemonials list';
        $test_data['description'] = 'List of Testemonials';
        $test_data['columns'] = array('Name', 'Body');

        if($type == "csv"){
            $this->export_to_csv($test_data);
        }else if($type == "json"){
            return $this->export_to_json($data);
        }else if($type == "pdf"){

            $test_data['columns_width'] = array('A'  =>  3,
                        'B'     =>  15,
                        'C'     =>  30,
                        'D'     =>  10,
                        'E'     =>  5,
                        'F'     =>  15);

            $this->export_to_pdf($test_data);
        }

        return;
    }

    /* Export END */
    /**
     * Save testemonials order
     */
    public function postSaveOrder()
    {
        $data = Input::get('data');
      
        $params = array();
        parse_str($data , $params);
        
        $response = array();
    ;
        if(count($params['item'])<1)
        {
            $response['state'] ='ok';
            $response['msg'] = "No models to sort";
        }
        else
        {
            $i=1;
        
            foreach($params['item'] as $param)
            {
                 $user = Testemonial::find($param);
                 $user->order = $i;
                 $user->save();
                 $i++;
            }

     
            $response['state'] ='ok';
            $response['msg'] = "Models are sorted";
        }
 
        return Response::json($response);
    }
}