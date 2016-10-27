<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;
use App\Order;
use DB;

class DashboardController extends AdminController
{
    // The index page for the dashboard\
    public function get_orders()
    {
        $orders = Order::leftJoin("subscriptions", "orders.subscription_id", "=", "subscriptions.id")
            ->select("orders.*", "subscriptions.stripe_id as stripe_id")
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get("orders")->toArray();

        return $orders;
    }

    public function get_products(){

        $products = DB::table('order_product')
            ->leftJoin("products", "order_product.product_id", "=", "products.id")
            ->groupBy("product_id")
            ->orderBy("total_sales", 'desc')
            ->select("products.id", 'products.name', 'products.price', 'products.images', DB::raw('SUM(products.price * order_product.quantity) as total_sales'))
            ->limit(5)
            ->get();

        return $products;
    }

    public function number_of_orders($period){

        if($period == "all"){
            $orders = DB::table('orders')
                ->where("orders.deleted_at", NULL)
                ->select('orders.*')
                ->get();
        }else{
            if($period == "today"){
                $start = date("Y-m-d")." 00:00:00";
                $end = date("Y-m-d", strtotime('+1 day', strtotime(date("Y-m-d")))). " 00:00:00";
            }else if($period == "yesterday"){
                $start = date("Y-m-d", strtotime('-1 day', strtotime(date("Y-m-d")))). " 00:00:00";
                $end = date("Y-m-d")." 00:00:00";
            }else if($period == 'week'){
                $start = date("Y-m-d", strtotime('-7 day', strtotime(date("Y-m-d")))). " 00:00:00";
                $end = date("Y-m-d")." 00:00:00";
            }else if($period == "month"){
                $start = date("Y-m-d", strtotime('-30 day', strtotime(date("Y-m-d")))). " 00:00:00";
                $end = date("Y-m-d")." 00:00:00";
            }

            $orders = DB::table('orders')
                ->where("created_at", ">=", $start)
                ->where("created_at", "<", $end)
                ->select('orders.*')
                ->get();
        }

        return count($orders);
    }

    public function orders_price($period){

        if($period == "all"){
            $price = DB::table('orders')
                ->where("orders.deleted_at", NULL)
                ->select(DB::raw('SUM(orders.price) as total_price'))
                ->get();

        }else{
            if($period == "today"){
                $start = date("Y-m-d")." 00:00:00";
                $end = date("Y-m-d", strtotime('+1 day', strtotime(date("Y-m-d")))). " 00:00:00";
            }else if($period == "yesterday"){
                $start = date("Y-m-d", strtotime('-1 day', strtotime(date("Y-m-d")))). " 00:00:00";
                $end = date("Y-m-d")." 00:00:00";
            }else if($period == 'week'){
                $start = date("Y-m-d", strtotime('-7 day', strtotime(date("Y-m-d")))). " 00:00:00";
                $end = date("Y-m-d")." 00:00:00";
            }else if($period == "month"){
                $start = date("Y-m-d", strtotime('-30 day', strtotime(date("Y-m-d")))). " 00:00:00";
                $end = date("Y-m-d")." 00:00:00";
            }

            $price = DB::table('orders')
                ->where("created_at", ">=", $start)
                ->where("created_at", "<", $end)
                ->select(DB::raw('SUM(orders.price) as total_price'))
                ->get();
        }

        return round ( $price[0]->total_price, 2);
    }

    public function get_orders_info(){

        $orders['today']['number'] = $this->number_of_orders("today");
        $orders['yesterday']['number'] = $this->number_of_orders("yesterday");
        $orders['week']['number'] = $this->number_of_orders("week");
        $orders['month']['number'] = $this->number_of_orders("month");
        $orders['all']['number'] = $this->number_of_orders("all");

        $orders['today']['price'] = $this->orders_price("today");
        $orders['yesterday']['price'] = $this->orders_price("yesterday");
        $orders['week']['price'] = $this->orders_price("week");
        $orders['month']['price'] = $this->orders_price("month");
        $orders['all']['price'] = $this->orders_price("all");

        return $orders;
    }

    public function index()
    {
        $orders = $this->get_orders();
        $products = $this->get_products();
        $orders_info = $this->get_orders_info();

        $today = $this->today();
        $today_revenue = $this->today_revenue();

        return view('admin.dashboard.index', compact('orders', 'products', 'today', 'today_revenue', 'orders_info'));
    }

    public function indexYesterday() {

        $orders = $this->get_orders();
        $products = $this->get_products();
        $orders_info = $this->get_orders_info();

        $yesterday = $this->yesterday();
        $yesterday_revenue = $this->yesterday_revenue();

        return view('admin.dashboard.indexYesterday', compact('orders', 'products', 'yesterday', 'yesterday_revenue', 'orders_info'));
    }
    
    public function index7Days() {

        $orders = $this->get_orders();
        $products = $this->get_products();
        $orders_info = $this->get_orders_info();

        $last7days = $this->last7days();
        $last7Days_revenue = $this->last7Days_revenue();

        return view('admin.dashboard.index7Days', compact('orders', 'products', 'last7days', 'last7Days_revenue', 'orders_info'));
    }

    public function index30Days() {

        $orders = $this->get_orders();
        $products = $this->get_products();
        $orders_info = $this->get_orders_info();

        $last30days = $this->last30days();
        $last30Days_revenue = $this->last30Days_revenue();

        return view('admin.dashboard.index30Days', compact('orders', 'products', 'last30days', 'last30Days_revenue', 'orders_info'));
    }
    
    public function indexAllTime() {

        $orders = $this->get_orders();
        $products = $this->get_products();
        $orders_info = $this->get_orders_info();

        $allTime = $this->allTime();
        $all_time_revenue = $this->all_time_revenue();

        return view('admin.dashboard.indexAllTime', compact('orders', 'products', 'allTime', 'all_time_revenue', 'orders_info'));
    }

    public function today() {
        
        $data = [
            [
                'y' => '100',
                'a' => 87

            ],
            [
                'y' => '100',
                'a' => 87
            ],
            [
                'y' => '200',
                'a' => 87
            ],
            [
                'y' => '800',
                'a' => 232
            ],
            [
                'y' => '100',
                'a' => 87
            ]
        ];
        
        return  json_encode($data);
    }
    
    public function yesterday() {

        $data = [
            [
                'y' => '1',
                'a' => 2
            ],
            [
                'y' => '4',
                'a' => 5
            ],
            [
                'y' => '7',
                'a' => 8
            ],
            [
                'y' => '8',
                'a' => 9
            ],
            [
                'y' => '11',
                'a' => 12
            ]
        ];

        return json_encode($data);
    }

    public function last7days() {

        $data = [
            [
                'y' => '1000',
                'a' => 700
            ],
            [
                'y' => '1025',
                'a' => 8700
            ],
            [
                'y' => '2001',
                'a' => 8722
            ],
            [
                'y' => '8002',
                'a' => 2323
            ],
            [
                'y' => '1000',
                'a' => 8736
            ]
        ];

        return json_encode($data);
    }
    
    public function last30days() {

        $data = [
            [
                'y' => '100',
                'a' => 87
            ],
            [
                'y' => '100',
                'a' => 87
            ],
            [
                'y' => '200',
                'a' => 87
            ],
            [
                'y' => '800',
                'a' => 232
            ],
            [
                'y' => '100',
                'a' => 87
            ]
        ];

        return json_encode($data);
    }

    public function allTime() {

        $data = [
            [
                'y' => '100',
                'a' => 87
            ],
            [
                'y' => '100',
                'a' => 87
            ],
            [
                'y' => '200',
                'a' => 87
            ],
            [
                'y' => '800',
                'a' => 232
            ],
            [
                'y' => '100',
                'a' => 87
            ]
        ];

        return json_encode($data);
    }
    
    public function today_revenue() {

        $data = [
            [
                'y' => '100',
                'a' => 87
            ],
            [
                'y' => '100',
                'a' => 87
            ],
            [
                'y' => '200',
                'a' => 87
            ],
            [
                'y' => '800',
                'a' => 232
            ],
            [
                'y' => '100',
                'a' => 87
            ]
        ];

        return json_encode($data);
    }
    public function yesterday_revenue() {

        $data = [
            [
                'y' => '100',
                'a' => 87
            ],
            [
                'y' => '100',
                'a' => 87
            ],
            [
                'y' => '200',
                'a' => 87
            ],
            [
                'y' => '800',
                'a' => 232
            ],
            [
                'y' => '100',
                'a' => 87
            ]
        ];

        return json_encode($data);
    }
    
    public function last7days_revenue() {

        $data = [
            [
                'y' => '100',
                'a' => 87
            ],
            [
                'y' => '100',
                'a' => 87
            ],
            [
                'y' => '200',
                'a' => 87
            ],
            [
                'y' => '800',
                'a' => 232
            ],
            [
                'y' => '100',
                'a' => 87

            ]
        ];

        return json_encode($data);
    }

    public function last30Days_revenue() {

        $data = [
            [
                'y' => '100',
                'a' => 87
            ],
            [
                'y' => '100',
                'a' => 87
            ],
            [
                'y' => '200',
                'a' => 87
            ],
            [
                'y' => '800',
                'a' => 232
            ],
            [
                'y' => '100',
                'a' => 87
            ]
        ];

        return json_encode($data);
    }
    
    public function all_time_revenue() {

        $data = [
            [
                'y' => '100',
                'a' => 87
            ],
            [
                'y' => '100',
                'a' => 87
            ],
            [
                'y' => '200',
                'a' => 87
            ],
            [
                'y' => '800',
                'a' => 232
            ],
            [
                'y' => '100',
                'a' => 87
            ]
        ];

        return json_encode($data);
    }

}
