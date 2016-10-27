@extends('admin._layouts.default')

@section('page_header')
     <h1>
    	Reports list
    </h1>
@endsection

@section('breadcrumb')
    <li class="active">Reports list</li>
@endsection


@section('content')
<br><br><br>
<div class="row">
   <center> <h3>Sales orders</h3></center>
        <br>
	<div class="col-xs-3">
		<a href="{{ url('admin/reports/orders_months') }}"><i class="fa fa-file-archive-o"></i> Orders by months</a>
	</div>
    <div class="col-xs-3">
		<a href="{{ url('admin/reports/orders_hours') }}"><i class="fa fa-file-archive-o"></i> Orders by hours</a>
	</div>
    <div class="col-xs-3">
		<a href="{{ url('admin/reports/orders_customers') }}"><i class="fa fa-file-archive-o"></i> Orders by customers</a>
	</div>
    <div class="col-xs-3">
		<a href="{{ url('admin/reports/orders_billings') }}"><i class="fa fa-file-archive-o"></i> Orders by billing address</a>
   </div>
</div>
<div class="row">
   
        <br>
	<div class="col-xs-3">
		<a href="{{ url('admin/reports/orders_billing_cities') }}"><i class="fa fa-file-archive-o"></i> Orders by billing cities</a>
	</div>
    <div class="col-xs-3">
		<a href="{{ url('admin/reports/orders_billing_states') }}"><i class="fa fa-file-archive-o"></i> Orders by billing states</a>
	</div>
    <div class="col-xs-3">

    </div>
    <div class="col-xs-3">
	
   </div>
</div>

<div class="row">
     <center> <h3>Orders payment</h3></center>
    
        <br>
	<div class="col-xs-3">
		<a href="{{ url('admin/reports/orders_payment_customers') }}"><i class="fa fa-file-archive-o"></i>Subscriptions by Custumers</a>
	</div>
        <div class="col-xs-3">
                    <a href="{{ url('admin/reports/subscriptions_plans') }}"><i class="fa fa-file-archive-o"></i>Subscriptions by plans</a>
        </div>
        <div class="col-xs-3">

        </div>
        <div class="col-xs-3">

       </div>
  
<div>
    
	<!-- Delete modal -->
	@include('admin._modals.danger')

</div>
@endsection