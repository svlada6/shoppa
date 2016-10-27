<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GenericController extends Controller
{
    //
    public function contact(){
        return view('welcome');
    }
}
