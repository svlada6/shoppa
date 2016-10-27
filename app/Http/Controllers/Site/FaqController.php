<?php

namespace App\Http\Controllers\Site;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SiteController;

use App\Faq;
use App\FaqCategory;

class FaqController extends Controller
{

    /**
     * Show the homepage.
     *
     * @return 
     */
    public function index()
    {
        $data = FaqCategory::with('getFaqList')->where('enabled', '=', '1')->get();  
        return view('site.faq.index', compact('data'));
    }

}