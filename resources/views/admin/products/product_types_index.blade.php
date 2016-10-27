@extends('admin._layouts.default')

@section('page_header')
	<h1>
    	Product Types List
    </h1>
@endsection

@section('breadcrumb')
    <li class="active">Dashboard</li>
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
				<div class="pull-right">
					<a href="{{ url('admin/product_types/create') }}" class="btn btn-small btn-info"><span class="glyphicon glyphicon-plus-sign"></span> Create New Type</a>
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
              	<h3 class="box-title">Product Vendors List</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              	<table id="faq_categories_table" class="table table-bordered table-striped table-hover">
                	<thead>
                  		<tr>
                    		<th>Name</th>
		                    <th>Status</th>
		                    <th>Date Added</th>
		                    <th>Actions</th>
                  		</tr>
                	</thead>
                	<tbody>
                  		@if( !empty( $data ) )
                  			@foreach( $data as $item )
                  				<tr id="{{ $item->id }}">
				                    <td>{{ $item->name }}</td>
				                    <td>
				                    	@if( $item->enabled )
				                    		<span class="label label-success">Enabled</span>
				                    	@else
				                    		<span class="label label-danger">Disabled</span>
				                    	@endif
				                    </td>
				                    <td>{{ date( 'F j, Y', strtotime($item->created_at)) }}</td>
				                    <td>
				                    	<a href="{{{ url('admin/product_types/'.$item->id.'/edit' ) }}}" class="btn btn-sm btn-info btn-editable" >Edit</a>
	                                    @if( $item->enabled )
	                                        <button class="btn btn-sm btn-warning update-row" type="button" data-value="0" data-target="{{ url('admin/product_types/update' ) }}">Disable</button>
	                                    @else
	                                        <button class="btn btn-sm btn-success update-row" type="button" data-value="1" data-target="{{ url('admin/product_types/update' ) }}">Enable</button>
	                                    @endif
	                                    <button class="btn btn-sm btn-danger delete-row" type="button" data-target="{{ url('admin/product_types/delete' ) }}" data-value="1">Delete</button>
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