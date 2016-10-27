@extends('admin._layouts.default')

@section('page_header')
    <h1>
        Discount List
    </h1>
@endsection

@section('breadcrumb')
    <li class="active">Dashboard</li>
@endsection

@section('content')
    @include('notifications.notifications')
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
                                <a href="{{ url('admin/discount/export/csv') }}">CSV</a>
                            </li>
                            <li>
                                <a href="{{ url('admin/discount/export/json') }}">JSON</a>
                            </li>
                            <li>
                                <a href="{{ url('admin/discount/export/pdf') }}">PDF</a>
                            </li>
                        </ul>
                    </div>
                    <div class="pull-right">
                        <a href="{{ url('admin/discount/create') }}" class="btn btn-small btn-info"><span class="glyphicon glyphicon-plus-sign"></span> Add New discount</a>
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
                    <h3 class="box-title">Discount List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="faq_categories_table" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            
                            <th>Details</th>
                            <th>Used</th>
                            <th>Start/End</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if( !empty( $discounts ) )
                            @foreach( $discounts as $discount )
                                <tr >
                                    
                                    <td>{{ $discount->code}}<br>
                                        {{$discount->checkCode($discount->discount_type)}}
                                    </td>
                                    <td>x</td>
                                    <td>
                                        Starts {{$discount->discount_begins->toFormattedDateString()}}<br>
                                        @if($discount->never_expires == 1)
                                            Expires --
                                        @elseif($discount->discount_ends->lt(\Carbon\Carbon::now()))
                                            Expired <span style="color: red">{{$discount->discount_ends->toFormattedDateString()}}</span>
                                        @else
                                            Expires {{$discount->discount_ends->toFormattedDateString()}}
                                        @endif
                                    </td>
                                    <td>
                                        
                                        <a href="/admin/discount/{{$discount->id}}/edit" class="btn btn-sm btn-info btn-editable" >Edit</a>
                                        @if( $discount->enabled )
                                        <button class="btn btn-sm btn-warning update-row" type="button" data-value="0" data-target="{{ url('/admin/discount/switch-status/' . $discount->id)}}">Disable</button>
                                        @else
                                        <button class="btn btn-sm btn-success update-row" type="button" data-value="1" data-target="{{ url('/admin/discount/switch-status/' . $discount->id)}}">Enable</button>
                                        @endif
                                        <a href="/admin/discount/{{$discount->id}}/delete" class="btn btn-sm btn-info btn-danger" onclick="return confirm('Are you sure?')">Delete</a>

                                        {{--<button class="btn btn-sm btn-danger delete-row" type="button" data-target="{{ url('admin/discount/delete' ) }}" data-value="1">Delete</button>--}}
                                        
<!--                                        <a class="btn btn-sm btn-primary"  href="{{ url('admin/discount/switch-status/'.$discount->id)}}" disabled>Disable</a>
                                        <a href="/admin/discount/{{$discount->id}}/delete"><span class="glyphicon glyphicon-trash pull-right" onclick="return confirm('Are you sure?')"></span></a>
                                        <a href="/admin/discount/{{$discount->id}}/edit"><span class="glyphicon glyphicon-edit" ></span></a>-->
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