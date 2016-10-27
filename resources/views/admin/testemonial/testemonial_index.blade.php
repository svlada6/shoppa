@extends('admin._layouts.default')

@section('page_header')
	<h1>
    	TESTEMONIAL's List
    </h1>
@endsection

@section('breadcrumb')
    <li class="active">Testemonials</li>
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
							<a href="{{ url('admin/testemonials/export_testemonials/csv') }}">CSV</a>
						</li>
						<li>
							<a href="{{ url('admin/testemonials/export_testemonials/json') }}">JSON</a>
						</li>
						<li>
							<a href="{{ url('admin/testemonials/export_testemonials/pdf') }}">PDF</a>
						</li>
					</ul>
				</div>
				<div class="pull-right">
					<a href="{{ url('admin/testemonials/create') }}" class="btn btn-small btn-info"><span class="glyphicon glyphicon-plus-sign"></span> Create New Testemonial</a>
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
              	<h3 class="box-title">Testemonial's List</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              	<table id="testemonials_table" class="table table-bordered table-striped table-hover">
                	<thead>
                  		<tr>
                    		<th>Name</th>
                                <th>Body</th>
                 	
		                    <th>Status</th>
		                    <th>Date Added</th>
		                    <th>Actions</th>
                  		</tr>
                	</thead>
                	<tbody id="sortable">
                  		@if( !empty( $data ) )
                  			@foreach( $data as $item )
                  				<tr id="item-{{$item->id}}">
				                    <td>{{ $item->name }}</td>
                                                     <td>{{ $item->body }}</td>
				                  
				                    <td>
				                    	@if( $item->enabled )
				                    		<span class="label label-success">Enabled</span>
				                    	@else
				                    		<span class="label label-danger">Disabled</span>
				                    	@endif
				                    </td>
				                    <td>{{ date( 'F j, Y', strtotime($item->created_at)) }}</td>
				                    <td>
				                    	<a href="{{ url('admin/testemonials/'.$item->id.'/edit' ) }}" class="btn btn-sm btn-info btn-editable" >Edit</a>
	                                    @if( $item->enabled )
	                                        <button class="btn btn-sm btn-warning update-row" type="button" data-value="0" data-target="{{ url('admin/testemonials/update' ) }}">Disable</button>
	                                    @else
	                                        <button class="btn btn-sm btn-success update-row" type="button" data-value="1" data-target="{{ url('admin/testemonials/update' ) }}">Enable</button>
	                                    @endif
	                                    <button class="btn btn-sm btn-danger delete-row" type="button" data-target="{{ url('admin/testemonials/delete' ) }}" data-value="1">Delete</button>
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

@section('scripts')
<script>
  
    $('#sortable').sortable({
        
        cursor: "move",
        update: function( ) {
           
            $.ajaxSetup(
            {
                headers:
                {
                    'X-CSRF-Token': '{{csrf_token()}}'
                }
            });


            var data = $("#sortable").sortable('serialize');
              

            $.ajax({
                        type:"POST",
                        url: '{{ url("admin/testemonials/save_order") }}',
                        dataType:"json",
                        data: {data: data} ,
                        beforeSend : function (){
                         
                            $("#erno").hide();
                        },
                        success  : function (data){
                            if(data.state=="ok"){
                                $("#erno").html(data.msg);
                                $("#erno").slideDown(500); 
                               //$("#submit").val("Finished!");
                            }else{
                                $("#erno").html(data.msg);
                                $("#erno").slideDown(500); 
                                // $("#submit").val("Submit");
                                // in_submit = false;
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(xhr.status);
                            alert(thrownError);
                        }
      
      })
     }
    });
</script>
@endsection
