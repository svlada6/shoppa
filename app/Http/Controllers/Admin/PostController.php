<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;

use DB;
use Auth;
use App\Post;
use App\PostCategory;
use App\User;
use Cocur\Slugify\Slugify;


class PostController extends AdminController
{

	/**
     * Show list.
     *
     * @param  array  $data
     * @return void
     */
    public function indexPages(){
        
    	$data = Post::where('post_type', '=', 'page')->get();

        return view( 'admin.posts.page_index', compact('data') );
    }


    /**
     * Show the form for creating new resource.
     *
     * @return void
     */
    public function getPageCreate()
    {
        $mode = 'create';
        return view( 'admin.posts.page_create_edit', compact('mode'));
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function postPageCreate(Request $request)
    {
        $this->validate($request, [
            'title'             => 'required|min:3|max:255',
            'body'              => 'required',
        ]);

        $slugify = new Slugify();

        Post::create([
            'title'             => $request->input('title'),
            'body'              => $request->input('body'),
            'author_id'         => Auth::user()->id,
            'category_id'       => 1,
            'meta_title'        => $request->input('meta_title'),
            'meta_tags'         => $request->input('meta_tags'),
            'meta_description'  => $request->input('meta_description'),
            'slug'              => $slugify->slugify($request->input('title')),
            'post_type'         => 'page',
        ]);

        // redirect
        return redirect('admin/pages')->with('status', 'success')->with('message', 'Successfully created!');
    }


    /**
     * Show the form for edit existing resource.
     *
     * @return void
     */
    public function getPageEdit( $id )
    {
        $data = Post::find($id);
        $mode = 'edit';

        if( $data )
            return view( 'admin.posts.page_create_edit', compact('data', 'mode'));
        else
            return redirect('admin/pages')->with('status', 'error')->with('message', 'Resource Not Found!');

        
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function postPageEdit(Request $request, $id)
    {

        $data = Post::find($id);

        if( $data )
        {
            $this->validate($request, [
                'title'             => 'required|min:3|max:255',
                'body'              => 'required',
            ]);

            $slugify = new Slugify();

            $update = [
                'title'             => $request->input('title'),
                'body'              => $request->input('body'),
                'author_id'         => Auth::user()->id,
                'category_id'       => 1,
                'meta_title'        => $request->input('meta_title'),
                'meta_tags'         => $request->input('meta_tags'),
                'meta_description'  => $request->input('meta_description'),
                'slug'              => $slugify->slugify($request->input('title')),
            ];

            Post::where('id', $id)->update($update);

            return redirect('admin/pages')->with('status', 'success')->with('message', 'Successfully updated');

        }
        else
        {
            return redirect('admin/pages')->with('status', 'error')->with('message', 'Error while editing the resource!');;
        }

    }











    // Blog Management

    /**
     * Show list.
     *
     * @param  array  $data
     * @return void
     */
    public function indexPosts(){
        
        // $data = Post::where('post_type', '=', 'post')->get();      
        $data = DB::table('posts')
            ->leftJoin('post_categories', 'posts.category_id', '=', 'post_categories.id')
            ->leftJoin('users', 'posts.author_id', '=', 'users.id')
            ->select('posts.*', 'post_categories.name', 'users.name as username')
            ->where('post_type', '=', 'post')
            ->get();  

        return view( 'admin.posts.post_index', compact('data') );
    }


    /**
     * Show the form for creating new resource.
     *
     * @return void
     */
    public function getPostCreate()
    {
        $mode = 'create';
        $categories = PostCategory::where('id', '>', '1')->get();
        $authors = User::all();

        return view( 'admin.posts.post_create_edit', compact('mode', 'categories', 'authors'));
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function postPostCreate(Request $request)
    {
        $this->validate($request, [
            'title'             => 'required|min:3|max:255',
            'body'              => 'required',
        ]);

        $slugify = new Slugify();

        Post::create([
            'title'             => $request->input('title'),
            'body'              => $request->input('body'),
            'author_id'         => $request->input('author_id'),
            'category_id'       => $request->input('category_id'),
            'meta_title'        => $request->input('meta_title'),
            'meta_tags'         => $request->input('meta_tags'),
            'meta_description'  => $request->input('meta_description'),
            'slug'              => $slugify->slugify($request->input('title')),
            'post_type'         => 'post',
        ]);

        // redirect
        return redirect('admin/posts')->with('status', 'success')->with('message', 'Successfully created!');
    }


    /**
     * Show the form for edit existing resource.
     *
     * @return void
     */
    public function getPostEdit( $id )
    {
        $data = Post::find($id);
        $mode = 'edit';
        $categories = PostCategory::where('id', '>', '1')->get();

        $authors = User::all();

        if( $data )
            return view( 'admin.posts.post_create_edit', compact('data', 'mode', 'categories', 'authors'));
        else
            return redirect('admin/posts')->with('status', 'error')->with('message', 'Resource Not Found!');

        
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function postPostEdit(Request $request, $id)
    {

        $data = Post::find($id);

        if( $data )
        {
            $this->validate($request, [
                'title'             => 'required|min:3|max:255',
                'body'              => 'required',
            ]);

            $slugify = new Slugify();

            $update = [
                'title'             => $request->input('title'),
                'body'              => $request->input('body'),
                'author_id'         => Auth::user()->id,
                'category_id'       => 1,
                'meta_title'        => $request->input('meta_title'),
                'meta_tags'         => $request->input('meta_tags'),
                'meta_description'  => $request->input('meta_description'),
                'slug'              => $slugify->slugify($request->input('title')),
            ];

            Post::where('id', $id)->update($update);

            return redirect('admin/posts')->with('status', 'success')->with('message', 'Successfully updated');

        }
        else
        {
            return redirect('admin/posts')->with('status', 'error')->with('message', 'Error while editing the resource!');;
        }

    }

    // End Blog Management


    /*Preview functinality for products*/
    public function postPreview( Request $request )
    {
        $input = $request->all();
        $user = User::where('id', '=', Auth::User()->id)->first();
        return view( 'site.blog.preview', compact('input', 'user'));
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
        $data = Post::find($request->input('id'));

        if( $data )
        {
            $this->validate($request, [
                'value' => 'required|numeric',
            ]);

            $update = [
                'enabled' => $request->input('value')
            ];

            Post::where('id', $request->input('id'))->update($update);

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
        $data = Post::find($request->input('id'));

        if( $data )
        {
            $this->validate($request, [
                'id' => 'required|numeric',
            ]);

            Post::where('id', $request->input('id'))->delete();

            return response()->json(['status' => 'success']);
        }
        else
        {
            return response()->json(['status' => 'error']);
        }
    }

    /* Export posts START */

    public function export($type){

        $data = Post::leftJoin('post_categories', 'posts.category_id', '=', 'post_categories.id')
            ->leftJoin('users', 'posts.author_id', '=', 'users.id')
            ->select('posts.id', 'posts.title', 'post_categories.name', 'users.name as username', 'posts.slug', 'posts.enabled', 'posts.created_at')
            ->where('post_type', '=', 'post')
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

        $page_data['data'] = $data;
        $page_data['title'] = 'Post list';
        $page_data['description'] = 'List of Posts';
        $page_data['columns'] = array('No', 'Title', 'Category', 'Author', 'Slug', 'Status', 'Date Added');

        if($type == "csv"){
            $this->export_to_csv($page_data);
        }else if($type == "json"){
            return $this->export_to_json($data);
        }else if($type == "pdf"){
            $page_data['columns_width'] = array('A'  =>  3,
                'B'     =>  15,
                'C'     =>  15,
                'D'     =>  10,
                'E'     =>  10,
                'F'     =>  15,
                'G'     =>  15 );
            $this->export_to_pdf($page_data);
        }

        return;
    }

    /* Export posts END */

    /* Export pages START */

    public function export_pages($type){

        $data = Post::where('post_type', '=', 'page')
            ->select("posts.id", "posts.title", 'posts.slug', 'posts.enabled', 'posts.created_at')
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

        $page_data['data'] = $data;
        $page_data['title'] = 'Page list';
        $page_data['description'] = 'List of Pages';
        $page_data['columns'] = array('No', 'Title', 'Slug', 'Status', 'Date Added');

        if($type == "csv"){
            $this->export_to_csv($page_data);
        }else if($type == "json"){
            return $this->export_to_json($data);
        }else if($type == "pdf"){
            $page_data['columns_width'] = array('A'  =>  3,
                'B'     =>  20,
                'C'     =>  20,
                'D'     =>  20,
                'E'     =>  20);
            $this->export_to_pdf($page_data);
        }

        return;
    }

    /* Export pages END */
}
