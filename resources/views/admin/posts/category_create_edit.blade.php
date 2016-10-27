@extends('admin._layouts.default')

@section('page_header')
    <h1>
        @if( $mode == 'edit' )
            Edit Blog Category
        @else
            New Blog Category
        @endif
    </h1>
@endsection

@section('breadcrumb')
    <li class="active">
        @if( $mode == 'edit' )
            Edit Category
        @else
            New Category
        @endif
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <!-- interactive chart -->
            <div class="box box-primary">
                <!-- form start -->
                <form class="form-horizontal" method="post" action='{{ $mode == 'edit' ? url("admin/post_category/$data->id/edit") : "" }}'>
                    <div class="box-header with-border">
                        <h3 class="box-title">                            
                            @if( $mode == 'edit' )
                                Edit {{ $data->title }} Category
                            @else
                                Create New Category
                            @endif
                        </h3>
                    </div>                    
                    {!! csrf_field() !!}                      
                    <div class="box-body">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="name" value="{{ $mode == 'edit' ? $data->name : old('name') }}" required />
                                @if ($errors->has('name'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>                                
                        </div>

                        @if( $mode == 'edit' )
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Slug</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="name" value="{{ $data->slug }}" disabled />
                            </div>                                
                        </div>
                        @endif
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <a href="{{ url('admin/post_category') }}" class="btn btn-default">Back to Categories List</a>
                        <input type="submit" class="btn btn-info pull-right" name="submit" value="{{ $mode == 'edit' ? 'Update' : 'Create' }}" />
                    </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection