<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Admin_right;
use \Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Order;
use App\Subscription;

class ReportController extends AdminController
{  
     /**
     * landing page for reports
     *
     * @param  array  $data
     * @return void
     */
    public function index()
    {    
       return View('admin.reports.report_index');
    }
    /**
     * show table orders grouped by months
     * @return type
     */
    public function getOrdersMonths()
    {      
       $data = Order::select(DB::raw('DATE_FORMAT(created_at,"%M %Y")  as date'), DB::raw('ROUND(SUM(price),2) AS price'),DB::raw('ROUND(SUM(subtotal),2) AS subtotal'),  DB::raw('COUNT(id) AS total'))->groupBy(DB::raw('MONTH(created_at)'))->get();
      
       return View('admin.reports.report_months',compact('data'));
    }

    /**
     * export orders months
     * @param type $type
     */
    public function exportOrdersMonths($type)
    {
        $data = Order::select(DB::raw('DATE_FORMAT(created_at,"%M %Y")  as date'), DB::raw('ROUND(SUM(price),2) AS price'),DB::raw('ROUND(SUM(subtotal),2) AS subtotal'),  DB::raw('COUNT(id) AS total'))->groupBy(DB::raw('MONTH(created_at)'))->get();
        $title = 'Orders by months';
        $desc = 'Reports for orders by months';
        $columns = ['Date', 'Sum of prices','Sum of subtotals','Total orders'];
        $this->export($type,$data,$title,$desc,$columns);
    }
     /**
     * show table by hours
     * @return type
     */
    public function getOrdersHours()
    {      
       $data = Order::select(DB::raw('DATE_FORMAT(created_at,"  %D %M %Y %h %p")  as date'), DB::raw('ROUND(SUM(price),2) AS price'),DB::raw('ROUND(SUM(subtotal),2) AS subtotal'),  DB::raw('COUNT(id) AS total'))->groupBy(DB::raw('HOUR(created_at)'))->get();
      
       return View('admin.reports.report_hours',compact('data'));

    }

    /**
     * export orders hours
     * @param type $type
     */
    public function exportOrdersHours($type)
    {
        $data = Order::select(DB::raw('DATE_FORMAT(created_at,"  %D %M %Y %h %p")  as date'), DB::raw('ROUND(SUM(price),2) AS price'),DB::raw('ROUND(SUM(subtotal),2) AS subtotal'),  DB::raw('COUNT(id) AS total'))->groupBy(DB::raw('HOUR(created_at)'))->get();
       
        $title = 'Orders by hours';
        $desc = 'Reports for orders by hours';
        $columns = ['Hours', 'Sum of prices','Sum of subtotals','Total orders'];
        $this->export($type,$data,$title,$desc,$columns);
    }
    
     /**
     * show table with custumers grouped by
     * @return type
     */
    public function getOrdersCustomers()
    {  
        $data = Order::select(DB::raw('users.email AS email'),DB::raw('users.name AS customer'), DB::raw('ROUND(SUM(price),2) AS price'),DB::raw('ROUND(SUM(subtotal),2) AS subtotal'),  DB::raw('COUNT(orders.id) AS total'))
        ->join('users', 'users.id', '=', 'orders.user_id')
        ->groupBy('orders.user_id')
        ->get();
          
       return View('admin.reports.report_customers',compact('data'));

    }

      /**
     * export orders customers
     * @param type $type
     */
    public function exportOrdersCustomers($type)
    {
         $data = Order::select(DB::raw('users.email AS email'),DB::raw('users.name AS customer'), DB::raw('ROUND(SUM(price),2) AS price'),DB::raw('ROUND(SUM(subtotal),2) AS subtotal'),  DB::raw('COUNT(orders.id) AS total'))
        ->join('users', 'users.id', '=', 'orders.user_id')
        ->groupBy('orders.user_id')
        ->get();
       
        $title = 'Orders by Customers';
        $desc = 'Reports for orders by Customers';
        $columns = ['Customer','Email', 'Sum of prices','Sum of subtotals','Total orders'];
        $this->export($type,$data,$title,$desc,$columns);
    }
    /**
     *show tabel billing addresses grouped by
     * @return type
     */
    public function getOrdersbillingAddresses()
    {  
         $data = Order::select(DB::raw('orders.billing_address_1 AS billing'), DB::raw('ROUND(SUM(price),2) AS price'),DB::raw('ROUND(SUM(subtotal),2) AS subtotal'),  DB::raw('COUNT(orders.id) AS total'))
        ->groupBy('orders.user_id')
        ->get();
      
       return View('admin.reports.report_billings',compact('data'));
    }

     /**
     * export orders billing addresses
     * @param type $type
     */
    public function exportOrdersBillingAddresses($type)
    {
        $data = Order::select(DB::raw('orders.billing_address_1 AS billing'), DB::raw('ROUND(SUM(price),2) AS price'),DB::raw('ROUND(SUM(subtotal),2) AS subtotal'),  DB::raw('COUNT(orders.id) AS total'))
        ->groupBy('orders.user_id')
        ->get();

        $title = 'Orders by Customers';
        $desc = 'Reports for orders by Customers';
        $columns = ['Billing address', 'Sum of prices','Sum of subtotals','Total orders'];
        $this->export($type,$data,$title,$desc,$columns);
    }
    /**
     * show tabel with billing cities grouped by
     * @return type
     */
    public function getOrdersBillingCities()
    {  
        $data = Order::select(DB::raw('orders.billing_city AS city'), DB::raw('ROUND(SUM(price),2) AS price'),DB::raw('ROUND(SUM(subtotal),2) AS subtotal'),  DB::raw('COUNT(orders.id) AS total'))
        ->groupBy('orders.user_id')
        ->get();
      
       return View('admin.reports.report_billing_cities',compact('data'));
    }

    /** export orders billing cities
     * @param type $type
     */
    public function exportOrdersBillingCities($type)
    {
        $data = Order::select(DB::raw('orders.billing_city AS city'), DB::raw('ROUND(SUM(price),2) AS price'),DB::raw('ROUND(SUM(subtotal),2) AS subtotal'),  DB::raw('COUNT(orders.id) AS total'))
        ->groupBy('orders.user_id')
        ->get();

        $title = 'Orders by Cities';
        $desc = 'Reports for orders by Cities';
        $columns = ['City', 'Sum of prices','Sum of subtotals','Total orders'];
        $this->export($type,$data,$title,$desc,$columns);
    }
    /**
     * show table with billing states
     * @return type
     */
    public function getOrdersBillingStates()
    {  
        $data = Order::select(DB::raw('states.state AS state'), DB::raw('ROUND(SUM(price),2) AS price'),DB::raw('ROUND(SUM(subtotal),2) AS subtotal'),  DB::raw('COUNT(orders.id) AS total'))
        ->join('states', 'states.id', '=', 'orders.billing_state_id')
        ->groupBy('orders.billing_state_id')
        ->get();

          return View('admin.reports.report_billing_states',compact('data'));
    }

      /** export orders billing states
     * @param type $type
     */
    public function exportOrdersBillingStates($type)
    {
        $data = Order::select(DB::raw('states.state AS state'), DB::raw('ROUND(SUM(price),2) AS price'),DB::raw('ROUND(SUM(subtotal),2) AS subtotal'),  DB::raw('COUNT(orders.id) AS total'))
        ->join('states', 'states.id', '=', 'orders.billing_state_id')
        ->groupBy('orders.billing_state_id')
        ->get();

        $title = 'Orders by States';
        $desc = 'Reports for orders by State';
        $columns = ['State', 'Sum of prices','Sum of subtotals','Total orders'];
        $this->export($type,$data,$title,$desc,$columns);
    }
    
     /**
     * Payment customer
     * @return type
     */
    public function getPaymentCustomers()
    {  
        $data = Subscription::select(DB::raw('users.name AS name'), DB::raw('users.email AS email'),DB::raw('subscriptions.stripe_plan as plan'))
        ->join('users', 'users.id', '=', 'subscriptions.user_id')
        ->get();

        return View('admin.reports.report_payment_customers',compact('data'));
    }
    /**
     * export for payment by customers
     * @param type $type
     */
    public function exportPaymentCustomers($type)
    {
         $data = Subscription::select(DB::raw('users.name AS name'), DB::raw('users.email AS email'),DB::raw('subscriptions.stripe_plan'))
        ->join('users', 'users.id', '=', 'subscriptions.user_id')
        ->get();

        $title = 'Payment by customer';
        $desc = 'Reports for payment by customer';
        $columns = ['Name', 'Email','Stripe plan'];
        $this->export($type,$data,$title,$desc,$columns);
    }
    
       /**
     * table for subscriptions plans
     * @return type
     */
    public function getSubscriptionsByPlans()
    {  
        $data = Subscription::select(DB::raw('stripe_plan'),  DB::raw('COUNT(id) AS total'))->groupBy(DB::raw('stripe_plan'))->get();

        return View('admin.reports.report_subscription_plans',compact('data'));
    }
    
    /**
     * export subscription plans
     * @param type $type
     */
    public function exportSubscriptionsByPlans($type)
    {
        $data = Subscription::select(DB::raw('stripe_plan'),  DB::raw('COUNT(id) AS total'))->groupBy(DB::raw('stripe_plan'))->get();

        $title = 'Subscription plans';
        $desc = 'Subscription plans';
        $columns = ['Name', 'Total number'];
        $this->export($type,$data,$title,$desc,$columns);
    }


    
    
 
    /* Export START */

   public function export($type,$data,$title,$description ,$columns)
   {
        $report_data['data'] = $data;
        $report_data['title'] = $title;
        $report_data['description'] = $description;
        $report_data['columns'] = $columns;
        
        if($type == "csv"){
            $this->export_to_csv($report_data);
        }else if($type == "json"){
            return $this->export_to_json($data);
        }else if($type == "pdf"){
             $report_data['columns_width'] = array('A'     =>  3,
                'B'     =>  20,
                'C'     =>  20,
                'D'     =>  20);
            $this->export_to_pdf($report_data);
        }

        return;
    }

    /* Export END */

}