<?php

namespace App\Http\Controllers\Site;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SiteController;
use App\Post;

class PagesController extends Controller
{

    /**
     * Show the homepage.
     *
     * @return 
     */
    public function how_it_works()
    {
        $data = Post::where('slug', '=', 'how-it-works')->first();
        return view('site.pages.how_it_works', compact('data'));
    }


    public function terms()
    {
        $data = Post::where('slug', '=', 'terms')->first();
        return view('site.pages.index', compact('data'));
    }


    public function privacy()
    {
        $data = Post::where('slug', '=', 'privacy')->first();
        return view('site.pages.index', compact('data'));
    }

}