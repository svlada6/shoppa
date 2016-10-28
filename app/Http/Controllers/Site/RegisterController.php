<?php

namespace App\Http\Controllers\Site;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SiteController;
use App\User;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\RegistrationRequest;

class RegisterController extends Controller
{

    /**
     * Show the homepage.
     *
     * @return 
     */
    public function index()
    {
        return view('site.register.index');
    }

    public function getLogin(RegistrationRequest $request)
    {
        $user = User::findOrFail(auth()->user()->id);

        if($user->hasRole(Config::get('constants.REGULAR_USER')))
        {
           return Redirect('order_plan');

        }
        elseif(!$user->hasRole(Config::get('constants.BACKEND_ADMIN')) ||
              !$user->hasRole(Config::get('constants.CUSTOMER_ADMIN')) ||
              !$user->hasRole(Config::get('constants.SUPPORT_ADMIN')) ||
              !$user->hasRole(Config::get('constants.FULFILLMENT')))

        {
            return Redirect('admin/dashboard');
        }
        else
        {
            return Redirect('/');
        }
    }

}