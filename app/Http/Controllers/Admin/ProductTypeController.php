<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;
// use Illuminate\Http\RedirectResponse;

use App\ProductType;

class ProductTypeController extends AdminController
{

    /**
     * Show the form for creating new resource.
     *
     * @param  array  $data
     * @return void
     */
    public function index()
    {
        $data = ProductType::all();
        return view( 'admin.products.product_types_index', compact('data') );
    }


    /**
     * Show the form for creating new resource.
     *
     * @return void
     */
    public function getCreate()
    {
        $mode = 'create';
        return view( 'admin.products.product_type_create_edit', compact('mode'));
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
	        'name' => 'required|min:3|max:255',
	    ]);

	    ProductType::create([
            'name' => $request->input('name'),
        ]);

        // redirect
        return redirect('admin/product_types')->with('status', 'success')->with('message', 'Successfully created!');
    }


    /**
     * Show the form for edit existing resource.
     *
     * @return void
     */
    public function getEdit( $id )
    {
        $data = ProductType::find($id);
        $mode = 'edit';

        if( $data )
            return view( 'admin.products.product_type_create_edit', compact('data', 'mode'));
        else
            return redirect('admin/product_types')->with('status', 'error')->with('message', 'Resource Not Found!');

        
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function postEdit(Request $request, $id)
    {

        $data = ProductType::find($id);

        if( $data )
        {
            $this->validate($request, [
                'name' => 'required|min:3|max:255',
            ]);

            $update = [
                'name' => $request->input('name')
            ];

            ProductType::where('id', $id)->update($update);

            return redirect('admin/product_types')->with('status', 'success')->with('message', 'Successfully updated');

        }
        else
        {
            return redirect('admin/product_types')->with('status', 'error')->with('message', 'Error while editing the resource!');;
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
        $data = ProductType::find($request->input('id'));

        if( $data )
        {
            $this->validate($request, [
                'value' => 'required|numeric',
            ]);

            $update = [
                'enabled' => $request->input('value')
            ];

            ProductType::where('id', $request->input('id'))->update($update);

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
        $data = ProductType::find($request->input('id'));

        if( $data )
        {
            $this->validate($request, [
                'id' => 'required|numeric',
            ]);

            ProductType::where('id', $request->input('id'))->delete();

            return response()->json(['status' => 'success']);
        }
        else
        {
            return response()->json(['status' => 'error']);
        }
    }
}