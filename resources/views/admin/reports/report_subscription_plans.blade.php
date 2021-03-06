@extends('admin._layouts.default')

@section('page_header')
	<h1>
          Subscription plans
         </h1>
@endsection

@section('breadcrumb')
    <li class="active">Subscription plans </li>
@endsection

@section('content')

<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			@if (session('status'))
			<div id="order_success" class="alert alert-block {{ session('status') == 'success' ? 'alert-success' : 'alert-danger' }}">
	            <button data-dismiss="alert" class="close" type="button">×</button>
	            {{ session('message') }}
	        </div>
	        @endif
			<h3>
				<div class="btn-group">
					<button class="btn btn-info" type="button">Export to</button>
					<button class="btn btn-info dropdown-toggle" data-toggle="dropdown" type="button">
						<span class="caret"></span>
						<span class="sr-only">Toggle Dropdown</span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li>
							<a href="{{ url('admin/reports/export_subscriptions_plans/csv') }}">CSV</a>
						</li>
						<li>
							<a href="{{ url('admin/reports/export_subscriptions_plans/json') }}">JSON</a>
						</li>
						<li>
							<a href="{{ url('admin/reports/export_subscriptions_plans/pdf') }}">PDF</a>
						</li>
					</ul>
				</div>
				
				<br>
			</h3>
		</div>	
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="box">
            <div class="box-header">
              	<h3 class="box-title">Subscription plans</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              	<table id="faq_categories_table" class="table table-bordered table-striped table-hover">
                	<thead>
                  		<tr>
                    		<th>Plan name</th>
                    		
                    		<th>Total orders</th>
                              
                    		</tr>
                	</thead>
                	<tbody>
                  		@if( !empty( $data ) )
                  			@foreach( $data as $item )
                  				<tr id="{{ $item->id }}">
				                    <td>{{ $item->stripe_plan }}</td>
				                    <td>{{ $item->total }}</td>
				                 
				                  
				
		                  		</tr>
                  			@endforeach
                  		@endif              
                	</tbody>
              	</table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
	</div>

	<!-- Delete modal -->
	@include('admin._modals.danger')

</div>
@endsection