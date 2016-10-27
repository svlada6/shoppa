<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;

use DB;
use App\Faq;
use App\FaqCategory;

class FaqController extends AdminController
{

    /**
     * Show the form for creating new resource.
     *
     * @param  array  $data
     * @return void
     */
    public function index()
    {
        $data = DB::table('faq')
            ->leftJoin('faq_categories', 'faq.faq_category_id', '=', 'faq_categories.id')
            ->select('faq.*', 'faq_categories.category_name')
            ->get();

        return view( 'admin.faq.faq_index', compact('data') );
    }


    /**
     * Show the form for creating new resource.
     *
     * @return void
     */
    public function getCreate()
    {
        $mode = 'create';
        $categories = FaqCategory::where('enabled', '1')->get();
        return view( 'admin.faq.faq_create_edit', compact('mode', 'categories'));
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
	        'faq_category_id'  => 'required',
	    ]);

	    Faq::create([
            'name'              => $request->input('name'),
            'body'              => $request->input('body'),
            'faq_category_id'   => $request->input('faq_category_id'),
        ]);

        // redirect
        return redirect('admin/faqs')->with('status', 'success')->with('message', 'Successfully created!');
    }


    /**
     * Show the form for edit existing resource.
     *
     * @return void
     */
    public function getEdit( $id )
    {
        $data = Faq::find($id);
        $mode = 'edit';
        $categories = FaqCategory::where('enabled', '1')->get();

        if( $data )
            return view( 'admin.faq.faq_create_edit', compact('data', 'mode', 'categories'));
        else
            return redirect('admin/faqs')->with('status', 'error')->with('message', 'Resource Not Found!');

        
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function postEdit(Request $request, $id)
    {

        $data = Faq::find($id);

        if( $data )
        {
            $this->validate($request, [
                'name'              => 'required|min:3|max:255',
                'body'              => 'required',
                'faq_category_id'   => 'required',
            ]);

            $update = [
                'name'              => $request->input('name'),
                'body'              => $request->input('body'),
                'faq_category_id'   => $request->input('faq_category_id'),
            ];

            Faq::where('id', $id)->update($update);

            return redirect('admin/faqs')->with('status', 'success')->with('message', 'Successfully updated');

        }
        else
        {
            return redirect('admin/faqs')->with('status', 'error')->with('message', 'Error while editing the resource!');;
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
        $data = Faq::find($request->input('id'));

        if( $data )
        {
            $this->validate($request, [
                'value' => 'required|numeric',
            ]);

            $update = [
                'enabled' => $request->input('value')
            ];

            Faq::where('id', $request->input('id'))->update($update);

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
        $data = Faq::find($request->input('id'));

        if( $data )
        {
            $this->validate($request, [
                'id' => 'required|numeric',
            ]);

            Faq::where('id', $request->input('id'))->delete();

            return response()->json(['status' => 'success']);
        }
        else
        {
            return response()->json(['status' => 'error']);
        }
    }

    /* Export START */

    public function export($type){

        $data = Faq::leftJoin('faq_categories', 'faq.faq_category_id', '=', 'faq_categories.id')
            ->select('faq.id', 'faq.name', 'faq.body', 'faq_categories.category_name', 'faq.enabled', 'faq.created_at')
            ->get();

        if(count($data) > 0){
            $counter = 1;
            foreach($data as $d){
                $d->id = $counter;
                if($d->enabled == "1"){
                    $d->enabled = "Enabled";
                }else{
                    $d->enabled = "Disabled";
                }
                $created_date = date( 'F j, Y', strtotime($d->created_at));
                $d->created_date = $created_date;
                unset($d->created_at);
                $counter++;
            }
        }

        $faq_data['data'] = $data;
        $faq_data['title'] = 'FAQ list';
        $faq_data['description'] = 'List of FAQ';
        $faq_data['columns'] = array('No', 'Question', 'Answer', 'Category', 'Status', 'Date Added');

        if($type == "csv"){
            $this->export_to_csv($faq_data);
        }else if($type == "json"){
            return $this->export_to_json($data);
        }else if($type == "pdf"){

            $faq_data['columns_width'] = array('A'  =>  3,
                        'B'     =>  15,
                        'C'     =>  30,
                        'D'     =>  10,
                        'E'     =>  5,
                        'F'     =>  15);

            $this->export_to_pdf($faq_data);
        }

        return;
    }

    /* Export END */
}