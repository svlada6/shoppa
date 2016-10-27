@extends('admin._layouts.default')

@section('page_header')
    <h1>
        Menu items List
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
                    <div class="pull-right">
                        <a href="{{ url('admin/menu-item/create') }}" class="btn btn-small btn-info"><span class="glyphicon glyphicon-plus-sign"></span> Create New Menu Item</a>
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
                    <h3 class="box-title">Menu Items List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="faq_categories_table" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Menu name</th>
                            <th>Caption</th>
                            <th>Url</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if( !empty( $menuItems ) )
                            @foreach( $menuItems as $menuItem )
                                <tr>
                                    <td>{{ $menuItem->menu->name}}</td>
                                    <td>{{ $menuItem->caption}}</td>
                                    <td>{{ $menuItem->url}}</td>
                                    <td class="text-center">
                                        <a href="/admin/menu-item/{{$menuItem->id}}/edit" class="btn btn-sm btn-info btn-editable" >Edit</a>
                                        @if( $menuItem->enabled )
                                            <button class="btn btn-sm btn-warning update-row" type="button" data-value="0" data-target="{{ url('/admin/menu-item/switch-status/' . $menuItem->id)}}">Disable</button>
                                        @else
                                            <button class="btn btn-sm btn-success update-row" type="button" data-value="1" data-target="{{ url('/admin/menu-item/switch-status/' . $menuItem->id)}}">Enable</button>
                                        @endif
                                        <button class="btn btn-sm btn-danger delete-row" type="button" data-target="{{ url("admin/menu-item/{$menuItem->id}/delete" ) }}" data-value="1">Delete</button>
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