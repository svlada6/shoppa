<?php

namespace App\Http\Controllers\Site;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SiteController;
use App\User;
use Illuminate\Support\Facades\Config;
use \Illuminate\Support\Facades\Auth;
use App\Order;

class ProfileController extends Controller
{

    /**
     * Show Profile form.
     *
     * @return 
     */
    public function index()
    {
        $user = Auth::User();
        return view('site.profile.index',compact('user'));
    }

    /**
     * Update data for user 
     * @param Request $request
     * @param type $id
     * @return type
     */
    public function postUpdate(Request $request,$id)
    {
        $rules =[
                    'name' =>'required',
                    'email'=>'required|email|unique:users,email,'.$id,
                    'password' => 'sometimes|alphaNum|min:6|same:password_confirmation',      
                ];

        $this->validate($request,$rules);

        User::find($id)->update([
                                    'name'=> $request->name,
                                    'email'=> $request->email,
                                    'password'=> bcrypt($request->password)
                                ]);

        return redirect('profile')->with('status', 'success')->with('message', 'Successfully updated!');
    }


    public function getUserOrders()
    {
        if( Auth::User() )
        {
            $data = Order::with('collections', 'products')->where('user_id', '=', Auth::User()->id)->where('is_gift', '=', '0')->get();  
            $gifts_data = Order::with('collections', 'products', 'gifts')->where('user_id', '=', Auth::User()->id)->where('is_gift', '=', '1')->get();  

            return view('site.profile.orders',compact('data', 'gifts_data'));
        }
        else
            return redirect('/');
    }   

}