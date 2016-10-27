<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;

use DB;
use App\PostCategory;
use Cocur\Slugify\Slugify;


class PostCategoryController extends AdminController
{

	/**
     * Show list.
     *
     * @param  array  $data
     * @return void
     */
    public function index(){
        
    	$data = PostCategory::all();

        return view( 'admin.posts.category_index', compact('data') );
    }


    /**
     * Show the form for creating new resource.
     *
     * @return void
     */
    public function getCreate()
    {
        $mode = 'create';
        return view( 'admin.posts.category_create_edit', compact('mode'));
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
            'name'             => 'required|min:3|max:255',
        ]);

        $slugify = new Slugify();

        PostCategory::create([
            'name'             => $request->input('name'),
            'slug'             => $slugify->slugify($request->input('name')),
        ]);

        // redirect
        return redirect('admin/post_category')->with('status', 'success')->with('message', 'Successfully created!');
    }


    /**
     * Show the form for edit existing resource.
     *
     * @return void
     */
    public function getEdit( $id )
    {
        $data = PostCategory::find($id);
        $mode = 'edit';

        if( $data )
            return view( 'admin.posts.category_create_edit', compact('data', 'mode'));
        else
            return redirect('admin/post_category')->with('status', 'error')->with('message', 'Resource Not Found!');

        
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function postEdit(Request $request, $id)
    {

        $data = PostCategory::find($id);

        if( $data )
        {
            $this->validate($request, [
                'name'             => 'required|min:3|max:255',
            ]);

            $slugify = new Slugify();

            $update = [
                'name'             => $request->input('name'),
                'slug'             => $slugify->slugify($request->input('name')),
            ];

            PostCategory::where('id', $id)->update($update);

            return redirect('admin/post_category')->with('status', 'success')->with('message', 'Successfully updated');

        }
        else
        {
            return redirect('admin/post_category')->with('status', 'error')->with('message', 'Error while editing the resource!');;
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
        $data = PostCategory::find($request->input('id'));

        if( $data )
        {
            $this->validate($request, [
                'value' => 'required|numeric',
            ]);

            $update = [
                'enabled' => $request->input('value')
            ];

            PostCategory::where('id', $request->input('id'))->update($update);

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
        $data = PostCategory::find($request->input('id'));

        if( $data )
        {
            $this->validate($request, [
                'id' => 'required|numeric',
            ]);

            PostCategory::where('id', $request->input('id'))->delete();

            return response()->json(['status' => 'success']);
        }
        else
        {
            return response()->json(['status' => 'error']);
        }
    }


}
