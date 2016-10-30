<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function getShowLoginForm()
    {
        return view('admin.auth.login');
    }
}
