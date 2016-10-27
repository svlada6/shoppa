<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;
// use Illuminate\Http\RedirectResponse;

use App\FaqCategory;

class FaqCategoryController extends AdminController
{

    /**
     * Show the form for creating new resource.
     *
     * @param  array  $data
     * @return void
     */
    public function index()
    {
        $data = FaqCategory::all();
        return view( 'admin.faq.categories_index', compact('data') );
    }


    /**
     * Show the form for creating new resource.
     *
     * @return void
     */
    public function getCreate()
    {
        $mode = 'create';
        return view( 'admin.faq.category_create_edit', compact('mode'));
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
	        'category_name' => 'required|min:3|max:255',
	    ]);

	    FaqCategory::create([
            'category_name' => $request->input('category_name'),
        ]);

        // redirect
        return redirect('admin/faq_categories')->with('status', 'success')->with('message', 'Successfully created!');
    }


    /**
     * Show the form for edit existing resource.
     *
     * @return void
     */
    public function getEdit( $id )
    {
        $data = FaqCategory::find($id);
        $mode = 'edit';

        if( $data )
            return view( 'admin.faq.category_create_edit', compact('data', 'mode'));
        else
            return redirect('admin/faq_categories')->with('status', 'error')->with('message', 'Resource Not Found!');

        
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function postEdit(Request $request, $id)
    {

        $data = FaqCategory::find($id);

        if( $data )
        {
            $this->validate($request, [
                'category_name' => 'required|min:3|max:255',
            ]);

            $update = [
                'category_name' => $request->input('category_name')
            ];

            FaqCategory::where('id', $id)->update($update);

            return redirect('admin/faq_categories')->with('status', 'success')->with('message', 'Successfully updated');

        }
        else
        {
            return redirect('admin/faq_categories')->with('status', 'error')->with('message', 'Error while editing the resource!');;
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
        $data = FaqCategory::find($request->input('id'));

        if( $data )
        {
            $this->validate($request, [
                'value' => 'required|numeric',
            ]);

            $update = [
                'enabled' => $request->input('value')
            ];

            FaqCategory::where('id', $request->input('id'))->update($update);

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
        $data = FaqCategory::find($request->input('id'));

        if( $data )
        {
            $this->validate($request, [
                'id' => 'required|numeric',
            ]);

            FaqCategory::where('id', $request->input('id'))->delete();

            return response()->json(['status' => 'success']);
        }
        else
        {
            return response()->json(['status' => 'error']);
        }
    }
}