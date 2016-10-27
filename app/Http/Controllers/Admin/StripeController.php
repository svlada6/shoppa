<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;

use App\Http\Requests;

class StripeController extends AdminController
{
    /**
     * Show stripe form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.stripe.stripe');
    }

    /**
     * Catch token from stripe and process payment
     *
     * @param Request $request
     * @return string
     */
    public function postStripe(Request $request)
    {
//        return $request->all();
        $token = $request->get('stripeToken');

//        auth()->user()->newSubscription('main', 'monthly')->create($token);
        auth()->user()->charge(1000);

        return 'Success';
    }
}
