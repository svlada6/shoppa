@extends('admin._layouts.default')

@section('page_header')
     <h1>
    	Customers List
    </h1>
@endsection

@section('breadcrumb')
    <li class="active">Customers</li>
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
							<a href="{{ url('admin/customers/export/csv') }}">CSV</a>
						</li>
						<li>
							<a href="{{ url('admin/customers/export/json') }}">JSON</a>
						</li>
						<li>
							<a href="{{ url('admin/customers/export/pdf') }}">PDF</a>
						</li>
					</ul>
				</div>
				<div class="pull-right">
					<a href="{{ url('admin/customers/create') }}" class="btn btn-small btn-info"><span class="glyphicon glyphicon-plus-sign"></span> Create New customer</a>
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
              	<h3 class="box-title">Customers List</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              	<table id="faq_categories_table" class="table table-bordered table-striped table-hover">
                	<thead>
                  		<tr>
                    		<th>Name</th>
                    		<th>Email</th>
		                <th>Role</th>
                                <th>Actions</th>
		       
                  		</tr>
                	</thead>
                	<tbody>
                  		@if( !empty( $data ) )
                  			@foreach( $data as $item )
                                        
                                      
                  				<tr >
				                    <td>{{ $item['name'] }}</td>
                                                    <td>{{ $item['email'] }}</td>
                                                    <td>{{ $item['role'] }}</td>
                                                    <td>         
                                                        <a class="btn btn-sm btn-primary update-row"  href="{{ url('admin/customers/edit/'.$item['id'] ) }}">Edit</a>
                                                        <button class="btn btn-sm btn-danger delete-row" type="button" data-target="{{ url('admin/customers/delete' ) }}" data-value='{{$item['id']}}'>Delete</button>
                                                    </td>
				             
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