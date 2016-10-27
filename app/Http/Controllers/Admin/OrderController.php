<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Order;

class OrderController extends Controller
{
    /**
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Order::with("products", "collections")
                ->leftJoin("users", "orders.user_id", "=","users.id" )
                ->leftJoin("subscriptions", "orders.subscription_id", "=","subscriptions.id" )
                ->leftJoin("states as bstates", "orders.billing_state_id", "=","bstates.id" )
                ->leftJoin("states as sstates", "orders.shipping_state_id", "=","sstates.id" )
                ->select("orders.*", "users.name as user_name", "subscriptions.stripe_id", 'bstates.state as billing_state_name', 'sstates.state as shipping_state_name')
            ->get("orders");

        return View('admin.orders.index', compact('data'));
    }

    /**
     * Delete record
     * @param Request $request
     * @return type
     */
    public function postDelete(Request $request)
    {
        $data = Order::find($request->input('value'));

        if ($data)
        {
            $this->validate($request,
                [
                    'value' => 'required|numeric',
                ]);

            $data->where('id', $request->input('value'))->delete();

            return response()->json(['status' => 'success']);
        }
        else
        {
            return response()->json(['status' => 'error']);
        }
    }

    public function postUpdate(Request $request, $id, $deliver)
    {
        $order = Order::find($id);
        $delivered = 0;
        if($deliver == "1"){
            $delivered = 1;
        }
        $order->delivered = $delivered;
        $order->save();

        return redirect('admin/orders');
    }

}
