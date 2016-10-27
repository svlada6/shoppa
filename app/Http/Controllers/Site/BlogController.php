<?php

namespace App\Http\Controllers\Site;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SiteController;
use App\Shipping_information;
use App\User;
use \Illuminate\Support\Facades\Auth;
use App\State;
use App\Role;

use App\Post;


class BlogController extends Controller
{

    /**
     * Show the homepage.
     *
     * @return 
     */
    public function index()
    {
        $data = Post::with('author')->where('enabled', '=', '1')->where('post_type', '=', 'post')->get();
        return view('site.blog.index', compact('data'));
    }

    public function showPost( $slug )
    {
        $data = Post::with('author')->where('enabled', '=', '1')->where('post_type', '=', 'post')->where('slug', '=', $slug)->first();

        if( $data )
            return view('site.blog.post', compact('data'));
        else
            return redirect('/');
    }


}