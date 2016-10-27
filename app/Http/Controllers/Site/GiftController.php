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

use App\Product;
use App\ProductType;
use App\ProductVendor;
use App\Collection;
use Cart;

class GiftController extends Controller
{

    public function getStepPlans()
    {
        Cart::destroy();
        return view('site.gifts.step1');
    }


    public function getStepPackages()
    {
        
        if( !Cart::content()->first() )
            return redirect('order_plan');

        if( Cart::content()->first() && (Cart::content()->first()->options->type == 'sample_package' ) )
            return redirect('order_billing');

        $products = Product::where('enabled', '=', '1')->get();
        $packages = Collection::where('enabled', '=', '1')->get();

        $cart_data = Cart::content()->first(); 

        $total_packages = Cart::content()->first()->packages ? array_sum(array_column(Cart::content()->first()->packages, 'quantity')) : 0;
        $total_products = Cart::content()->first()->products ? array_sum(array_column(Cart::content()->first()->products, 'quantity')) : 0;

        $total_in_cart = $total_products + $total_packages;

        return view('site.gifts.step2', compact('products', 'packages', 'cart_data', 'total_in_cart'));
    }


    public function getStepBilling()
    {
        if( !Cart::content()->first() )
            return redirect('order_plan');
        else
        {
            if( ( Cart::content()->first()->options->type == 'standard_package' ) && ( !Cart::content()->first()->packages && !Cart::content()->first()->products ))
                return redirect('order_packages');
        }

        $cart_data = Cart::content()->first();
        session()->put('subtotal', $cart_data->subtotal);

        //dd($cart_data);

        $states = State::lists('state','id');

        if(Auth::check())
        {
            $user =  Auth::User();
            $shipping = $user->shipping_informations;
            $billing =  $user->billing_informations;
        }
        else
        {
            $shipping=[];
            $billing=[];
        }
        return view('site.gifts.step3', compact('cart_data', 'states','billing','shipping'));
    }


    /**
     * Update 
     * @param Request $request
     * @return type
     */
    public function postStep3(Request $request)
    {
        $rules =[
                    'first_name' =>'required',
                    'last_name' =>'required',
                    'address_1' =>'required',
                    'city' => 'required',
                    'postal' => 'required',
                 ];
        if($request->new_user == true)
        {
            $rules['name'] = 'required';
            $rules['email'] = 'required|email|max:255|unique:users';
            $rules['password'] = 'required|same:c_password|min:6';
        }
        
        $this->validate($request,$rules);
        if($request->new_user == true)
        {
            $user =  User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

             $role = Role::where( 'name', '=', 'Regular user' )->first();
             $user->attachRole($role);
             $user->save();
             Auth::login($user);
        }
        return Redirect('gift_billing');
    }

}