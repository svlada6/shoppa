<?php

namespace App\Http\Controllers\Site;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SiteController;
use App\Collection;
use Cart;
use App\Order;
use App\OrderGift;
use App\Email_temp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;


class StripeController extends  Controller
{
    private $cart;
    private $token;
    private $stripeId;
    /**
     * Show stripe form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('site.stripe.stripe');
    }

    /**
     * Catch token from stripe and process payment save into order
     *
     * @param Request $request
     * @return string
     */
    public function postStripe(Request $request)
    {
        $this->token = $request->get('stripeToken');
        $user = auth()->user();
        $this->cart = Cart::content()->first();

        $plan = $this->getPlan($this->cart->name, $this->cart->options->delivery);

        $this->checkPlan($plan);
        $this->chargeUser($plan);

        $orders_insert_array = [];


        $orders_insert_array = [
            'name'              => $this->cart->name,
            'price'             => $this->cart->price,
            'user_id'           => $user->id,
            'subscription_id'   => $this->stripeId,
            'subtotal'          => $this->cart->subtotal,
        ];

        $orders_insert_array['shipping_first_name'] = $request->get('shipping_first_name');
        $orders_insert_array['shipping_last_name']  = $request->get('shipping_last_name');
        $orders_insert_array['shipping_company']    =   $request->get('shipping_company');
        $orders_insert_array['shipping_address_1']  = $request->get('shipping_address_1');
        $orders_insert_array['shipping_address_2']  = $request->get('shipping_address_2');
        $orders_insert_array['shipping_city']       = $request->get('shipping_city');
        $orders_insert_array['shipping_state']      = $request->get('shipping_state');
        $orders_insert_array['shipping_postal']     = $request->get('shipping_postal');
        $orders_insert_array['shipping_state_id']   = $request->get('shipping_state');


        //Depends on checkbox
        if($request->get('same_billing') == 1)
        {
            $orders_insert_array['billing_first_name']    = $request->get('shipping_first_name');
            $orders_insert_array['billing_last_name']     = $request->get('shipping_last_name');
            $orders_insert_array['billing_company']       =   $request->get('shipping_company');
            $orders_insert_array['billing_address_1']     = $request->get('shipping_address_1');
            $orders_insert_array['billing_adress_2']      = $request->get('shipping_address_2');
            $orders_insert_array['billing_city']          = $request->get('shipping_city');
            $orders_insert_array['billing_state']         = $request->get('shipping_state');
            $orders_insert_array['billing_postal']        = $request->get('shipping_postal');
            $orders_insert_array['billing_state_id']      = $request->get('shipping_state');
        }
        else
        {
            $orders_insert_array['billing_first_name']    = $request->get('billing_first_name');
            $orders_insert_array['billing_last_name']     = $request->get('billing_last_name');
            $orders_insert_array['billing_company']       =   $request->get('billing_company');
            $orders_insert_array['billing_address_1']     = $request->get('billing_address_1');
            $orders_insert_array['billing_address_2']     = $request->get('billing_address_2');
            $orders_insert_array['billing_city']          = $request->get('billing_city');
            $orders_insert_array['billing_state']         = $request->get('billing_state');
            $orders_insert_array['billing_postal']        = $request->get('billing_postal');
            $orders_insert_array['billing_state_id']      = $request->get('billing_state');
        }

        if( $request->get('is_gift') )
        {
            $orders_insert_array['is_gift']      = 1;
        }

        $order = Order::create($orders_insert_array);

        if( $request->get('is_gift') )
        {
            $gift_insert_array = [];
            $gift_insert_array['first_name']  = $request->get('from_first_name');
            $gift_insert_array['last_name']   = $request->get('from_last_name');
            $gift_insert_array['email']       = $request->get('from_email');
            $gift_insert_array['note']        = $request->get('gift_note');
            $gift_insert_array['order_id']    = $order->id;

            $order_gift = OrderGift::create($gift_insert_array);
        }


        // If all good and this is a gift, create record for the sender with the input data



       $order = Order::create($orders_insert_array);


        $records_array = [];

        if($this->cart->products)
        {

           foreach( $this->cart->products as $k => $v)
           {
               $records_array[] = $k;
            }

            $order->products()->attach($records_array , ['name'=>$v['name'], 'quantity'=> $v['quantity']]);
        }

        if($this->cart->packages)
        {
            foreach( $this->cart->packages as $k => $v)
           {
               $order->collections()->attach($k,  ['name'=>$v['name'], 'quantity'=> $v['quantity']]);
               $collection = Collection::find($k)->products;

               foreach($collection as $coll)
               {
               $order->products()->attach($coll->id,  ['name'=>$coll->name, 'quantity'=> 1, 'collection' =>$k]);
               }
           }
        }

        $data = Email_temp::where('name','=','orders')->first();

        if($data)
        {
            $variables = $data->variables;

            $test_data['customer']     = $user->name;
            $test_data['product']      = $this->cart->name;
            $test_data['subtotal'] = $this->cart->subtotal;
            $test_data['price']        = $this->cart->price;
            $test_data['order']        = '123456 Abc';

            if ($variables->first())
            {
                foreach ($variables as $var)
                {
                    if (isset($test_data[$var->name]))
                    {
                        $stringtoreplace[] = '%#'.$var->name.'#%';
                        $replace[]         = $test_data[$var->name];
                    }
                }

                $template['data'] = str_replace($stringtoreplace, $replace,
                    $data->content);
                $subject          = str_replace($stringtoreplace, $replace,
                    $data->subject);
            }
            else
            {
                $template['data'] = $data->content;
                $subject          = $data->subject;
            }

           /* Mail::send('admin.emails.template', $template,
                function($message) use($subject) {
                $message->to(Config::get('constants.TEST_EMAIL'), 'Test Mail')->subject($subject)->from(Config::get('constants.TEST_EMAIL'));
            });*/
        }

       return redirect('stripe/success');
    }


    /**
     * Show success page
     * @return type
     */
    public function getSuccess()
    {
        return View('site.stripe.success');
    }

    /**
     * Get payment plan
     *
     * @param  string $cartName
     * @param  string $cartDelivery
     * @return string
     */
    private function getPlan($cartName, $cartDelivery)
    {
        switch ($cartDelivery) {
            case "Every month FREE":
                if ($cartName == '48 Cups') {
                    $plan = 'Every month 48 cups';
                } elseif ($cartName == '24 Cups') {
                    $plan = 'Every month 24 cups';
                } elseif ($cartName == '96 Cups') {
                    $plan = 'Every month 96 cups';
                }
                break;

            case "Every 2 months FREE":
                if ($cartName == '48 Cups') {
                    $plan = 'Every 2 month 48 cups';
                } elseif ($cartName == '24 Cups') {
                    $plan = 'Every 2 month 24 cups';
                } elseif ($cartName == '96 Cups') {
                    $plan = 'Every 2 month 96 cups';
                }
                break;

            case "Every 3 months FREE":
                if ($cartName == '48 Cups') {
                    $plan = 'Every 3 month 48 cups';
                } elseif ($cartName == '24 Cups') {
                    $plan = 'Every 3 month 24 cups';
                } elseif ($cartName == '96 Cups') {
                    $plan = 'Every 3 month 96 cups';
                }
                break;

            default:
                $plan = 'No plan';
        }

        return $plan;
    }

    /**
     * Process payment
     *
     * @param  string $plan
     * @return string
     */
    private function chargeUser($plan)
    {
        if ($plan == 'No plan') {
            $this->stripeId = '';
            try {
                auth()->user()->charge((int)$this->cart->price * 100, ['source' => $this->token]);
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        } else {
            try {
                $stripe = auth()->user()->newSubscription('main', $plan)->create($this->token);
                $this->stripeId = $stripe->id;
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
    }

    /**
     * Check if user already have been subscribed to any plan
     *
     * @param  string $plan
     * @return bool
     */
    private function checkPlan($plan)
    {
        // single charges
        if ($plan == 'No plan') {
            return true;
        }

        $userPlans = auth()->user()->subscriptions()->lists('stripe_plan')->toArray();

        if (!empty($userPlans)) {
            abort(400, 'Already subscribed to another plan');
        }

        return true;
    }

    /**
     * Cancel user subscription
     */
    public function cancelSubscription()
    {
        auth()->user()->subscription('main')->cancel();

        return back()->with('message', 'Successfully canceled');
    }

    /**
     * Show current stripe plan
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function stripeDashboard()
    {
        if(! Auth::check()) {
            return back();
        }

        $user = auth()->user();

        if(count($user->subscriptions)) {
            $userPlan = $user->subscriptions()->first();
        } else {
            $userPlan = null;
        }

        return view('site.stripe.dashboard', compact('userPlan'));
    }
}
