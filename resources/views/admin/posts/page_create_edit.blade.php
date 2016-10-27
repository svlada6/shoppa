@extends('admin._layouts.default')

@section('page_header')
    <h1>
        @if( $mode == 'edit' )
            Edit Page
        @else
            New Page
        @endif
    </h1>
@endsection

@section('breadcrumb')
    <li class="active">
        @if( $mode == 'edit' )
            Edit Page
        @else
            New Page
        @endif
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <!-- interactive chart -->
            <div class="box box-primary">
                <!-- form start -->
                <form class="form-horizontal" method="post" action='{{ $mode == 'edit' ? url("admin/pages/$data->id/edit") : "" }}'>
                    <div class="box-header with-border">
                        <h3 class="box-title">                            
                            @if( $mode == 'edit' )
                                Edit {{ $data->title }} Page
                            @else
                                Create New Page
                            @endif
                        </h3>
                    </div>                    
                    {!! csrf_field() !!}                      
                    <div class="box-body">
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="title" value="{{ $mode == 'edit' ? $data->title : old('title') }}" required />
                                @if ($errors->has('title'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>                                
                        </div>

                        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Page Body</label>
                            <div class="col-sm-10">
                                <textarea id="editor1" name="body" rows="10" cols="80">
                                    {{ $mode == 'edit' ? $data->body : old('body') }}                                           
                                </textarea>
                                @if ($errors->has('body'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>                                
                        </div>
                    </div><!-- /.box-body -->

                    <!-- Tags start -->
                    <div class="box-header with-border">
                        <h3 class="box-title">                            
                            Tags
                        </h3>
                    </div>                    
                    
                    <div class="box-body">
                        <div class="form-group{{ $errors->has('meta_tags') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Tags</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="meta_tags" value="{{ $mode == 'edit' ? $data->meta_tags : old('meta_tags') }}" />
                                @if ($errors->has('meta_tags'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('meta_tags') }}</strong>
                                    </span>
                                @endif
                            </div>                                
                        </div>
                    </div><!-- /.box-body -->
                    <!-- Tags End -->


                    <!-- Search Engines start -->
                    <div class="box-header with-border">
                        <h3 class="box-title">                            
                            Search Engines
                        </h3>
                    </div>                    
                    
                    <div class="box-body">
                        <div class="form-group{{ $errors->has('meta_title') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Page Title</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="meta_title" value="{{ $mode == 'edit' ? $data->meta_title : old('meta_title') }}" />
                                @if ($errors->has('meta_title'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('meta_title') }}</strong>
                                    </span>
                                @endif
                            </div>                                
                        </div>
                        <div class="form-group{{ $errors->has('meta_description') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Meta Description</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="meta_description" value="{{ $mode == 'edit' ? $data->meta_description : old('meta_description') }}" />
                                @if ($errors->has('meta_description'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('meta_description') }}</strong>
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
                    <!-- Search Engines End -->


                    <div class="box-footer">
                        <a href="{{ url('admin/pages') }}" class="btn btn-default">Back to Pages List</a>
                        <input type="submit" class="btn btn-info pull-right" name="submit" value="{{ $mode == 'edit' ? 'Update' : 'Create' }}" />
                    </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection