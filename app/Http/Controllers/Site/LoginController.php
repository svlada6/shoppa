<?php

namespace App\Http\Controllers\Site;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SiteController;
use App\User;
use Illuminate\Support\Facades\Config;

class LoginController extends Controller
{

    /**
     * Show the homepage.
     *
     * @return 
     */
    public function index()
    {
        return view('site.login.index');
    }
    
    /*
     * Handles user login 
     * 
     */
    public function getLogin()
    { 
        $userModel = new User();
        $redirect  = $userModel->loginUser();       
        return Redirect($redirect);
    }

}