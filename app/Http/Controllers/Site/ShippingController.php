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


class ShippingController extends Controller
{

    /**
     * Show the homepage.
     *
     * @return 
     */
    public function index()
    {
        $states = State::lists('state','id');
        $user = Auth::User()->shipping_informations;

        return view('site.shipping.index',compact('states','user'));
    }

    /**
     * Update data for shipping table
     * @param Request $request
     * @param type $id
     * @return type
     */
    public function postUpdate(Request $request,$id)
    {
        $rules =[
                'first_name' =>'required',
                'last_name' =>'required',
                'address_1' =>'required',
                'city' => 'required',
                'postal' => 'required',
                 ];
      
        $this->validate($request,$rules);
        
        $shipping_information =     Shipping_information::where('user_id',$id);
        
        if($shipping_information->first())
        {
             $shipping_information->update($request->except('_token','user_id'));
        }
        else
        {      
            Shipping_information::create([
                
               'first_name' => $request->get('first_name'),
               'last_name' => $request->get('last_name'),
               'address_1' => $request->get('address_1'),
               'address_2' => $request->get('address_2'),
               'city' => $request->get('city'),
               'user_id' => $request->get('user_id'),
               'state' => $request->get('state'),
               'postal' => $request->get('postal')

           ]);
        }
        return redirect('shipping')->with('status', 'success')->with('message', 'Successfully updated!');
    }

}