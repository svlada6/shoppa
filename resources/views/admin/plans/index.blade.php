@extends('admin._layouts.default')

@section('page_header')
    <h1>
        Plans List
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
                        <a href="{{ url('admin/plans/create') }}" class="btn btn-small btn-info"><span class="glyphicon glyphicon-plus-sign"></span> Create New Plan</a>
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
                    <h3 class="box-title">Plans List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="faq_categories_table" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>

                            <th>Name</th>
                            <th>Cups amount</th>
                            <th>Price per cup</th>
                            <th>Discount</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Shipping plan</th>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                        @if( !empty( $plans ) )
                            @foreach( $plans as $plan )
                                <tr id="{{ $plan->id }}">
                                    <td>{{$plan->name}}</td>
                                    <td>{{$plan->cups_amount}}</td>
                                    <td>{{ $plan->price_per_cup }}</td>
                                    <td>{{ $plan->discount }}</td>
                                    <td>{{ $plan->price }}</td>
                                    <td>{{ $plan->featured_image }}</td>
                                    <td>{{ $plan->shipping_plan }}</td>
                                    <td>
                                        <a href="{{{ url('admin/plans/'.$plan->id.'/edit' ) }}}" class="btn btn-sm btn-info btn-editable" >Edit</a>
                                        @if( $plan->enabled )
                                            <button class="btn btn-sm btn-warning update-row" type="button" data-value="0" data-target="{{ url('admin/plans/update' ) }}">Disable</button>
                                        @else
                                            <button class="btn btn-sm btn-success update-row" type="button" data-value="1" data-target="{{ url('admin/plans/update' ) }}">Enable</button>
                                        @endif
                                        <a href="{{{ url('admin/plan/'.$plan->id.'/delete' ) }}}" class="btn btn-sm btn-info btn-danger" onclick="return confirm('Are you sure?')">Delete</a>

                                        {{--<button class="btn btn-sm btn-danger delete-row" type="button" data-target="{{ url('admin/plans/delete' ) }}" data-value="1">Delete</button>--}}
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

@endsection