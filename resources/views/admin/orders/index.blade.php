@extends('admin._layouts.default')

@section('page_header')
    <h1>
        Orders
    </h1>
@endsection

@section('breadcrumb')
    <li class="active">Orders</li>
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
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Orders list</h3>
                </div>
                <div class="box-body">
                    <table id="faq_categories_table" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Plan</th>
                            <th>Price</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if( !empty( $data ) )
                            @foreach( $data as $item )
                                <tr>
                                    <td>{{ $item['stripe_id'] }}</td>
                                    <td>{{ $item['user_name'] }}</td>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['price'] }}</td>
                                    <td>{{ $item['subtotal'] }}</td>
                                    <td>
                                        @if( $item['delivered'] )
                                            <span class="label label-success">Delivered</span>
                                        @else
                                            <span class="label label-danger">Not delivered</span>
                                        @endif
                                    </td>
                                    <td>{{ date( 'F j, Y', strtotime($item['created_at'])) }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info btn-editable details-row" type="button" data-target="{{ url('admin/orders/details' ) }}">Details</button>
                                        <button class="btn btn-sm btn-danger delete-row" type="button" data-target="{{ url('admin/orders/delete' ) }}" data-value='{{$item['id']}}'>Delete</button>
                                        @if(!$item['delivered'] )
                                            <a class="btn btn-sm btn-success"  href="{{ url('admin/orders/update/'.$item['id'].'/1' ) }}">Deliver</a>
                                        @else
                                            <a class="btn btn-sm btn-warning"  href="{{ url('admin/orders/update/'.$item['id'].'/0' ) }}">Postpone</a>
                                        @endif
                                        @include('admin.orders.detail', compact('item'))
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Delete modal -->
        @include('admin._modals.danger')

    </div>
@endsection


