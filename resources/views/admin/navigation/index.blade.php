@extends('admin._layouts.default')

@section('page_header')
    <h1>
        Menus List
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
{{--                        <a href="{{ url('admin/navigation/create') }}" class="btn btn-small btn-info"><span class="glyphicon glyphicon-plus-sign"></span> Manage Navigation</a>--}}
                        <a href="{{ url('admin/navigation/create') }}" class="btn btn-small btn-info"><span class="glyphicon glyphicon-plus-sign"></span> Create menu</a>
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
                    <h3 class="box-title">Navigation List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="faq_categories_table" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <td>id</td>
                            <th>Link Name</th>
                            <th>Link To</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if( !empty( $posts ) )
                            @foreach( $posts as $post )
                                <tr >
                                    <td>{{$post->id}}</td>
                                    <td>{{$post->title}} </td>
                                    <td>{{$post->checkLink()}}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary"  href="/admin/navigation/{{$post->id}}/edit" >Edit</a>
                                        <a href="/admin/navigation/{{$post->id}}/delete"><span class="glyphicon glyphicon-trash pull-right" onclick="return confirm('Are you sure?')"></span></a>
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