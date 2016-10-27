<?php

namespace App\Http\Controllers\Site;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SiteController;
use Mail;
use Validator;

class ContactController extends Controller
{

    /**
     * Show the homepage.
     *
     * @return 
     */
    public function index()
    {
        return view('site.contact.index');
    }

    public function contactUs(Request $request)
    {
        $data['name'] = $request->get("name");
        $data['email'] = $request->get("email");
        $data['comment'] = $request->get("comment");

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'comment' => 'required|string|max:500',
        ]);

        $msg = '';
        if ($validator->fails()) {
            $errors = $validator->messages();
        }else{
            Mail::send('site.contact.email', ['data' => $data], function ($m) use ($data) {
                $m->from($data['email'], $data['name']);
                $m->to('dragana.cosmic@gmail.com', "Coffee team")->subject("Note from customer");
            });
            $msg = "E-mail was successfully sent";
            $data['name'] = '';
            $data['email'] = '';
            $data['comment'] = '';
        }

        return view('site.contact.index', compact('msg', 'errors', 'data'));
    }
}