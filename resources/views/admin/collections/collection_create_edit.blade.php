@extends('admin._layouts.default')

@section('page_header')
    <h1>
        @if( $mode == 'edit' )
            Edit Collection
        @else
            New Collection
        @endif
    </h1>
@endsection

@section('breadcrumb')
    <li class="active">
        @if( $mode == 'edit' )
            Edit Collection
        @else
            New Collection
        @endif
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <!-- interactive chart -->
            <div class="box box-primary">
                <!-- form start -->
                <form id="myform" class="form-horizontal" method="post" action='{{ $mode == 'edit' ? url("admin/collections/$data->id/edit") : "" }}' enctype='multipart/form-data'>
                    <div class="box-header with-border">
                        <h3 class="box-title">                            
                            @if( $mode == 'edit' )
                                Edit {{ $data->title }} Collection
                            @else
                                Create New Collection
                            @endif
                        </h3>
                    </div>                    
                    {!! csrf_field() !!}                      
                    <div class="box-body">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="name" value="{{ $mode == 'edit' ? $data->name : old('name') }}" required />
                                @if ($errors->has('name'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>                                
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                <textarea id="editor1" name="description" rows="10" cols="80">
                                    {{ $mode == 'edit' ? $data->description : old('description') }}                                           
                                </textarea>
                                @if ($errors->has('description'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>                                
                        </div>

                        @if( $mode == 'create' )
                            <div class="form-group{{ $errors->has('featured_image') ? ' has-error' : '' }}">
                                <label class="col-sm-2 control-label">Featured Image</label>
                                <div class="col-sm-10">
                                    <input type="file" name="featured_image" />
                                    @if ($errors->has('featured_image'))
                                        <span class="text-red">
                                            <strong>{{ $errors->first('featured_image') }}</strong>
                                        </span>
                                    @endif
                                </div>                                
                            </div>
                        @else
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Uploaded Featured Image</label>
                                <div class="col-sm-10">
                                    @if( $data->featured_image )
                                        <img width="200" src={{ asset($data->featured_image) }} />
                                    @else
                                        No Image Uploaded
                                    @endif
                                </div>                                
                            </div>

                            <div class="form-group{{ $errors->has('featured_image') ? ' has-error' : '' }}">
                                <label class="col-sm-2 control-label">Featured Image</label>
                                <div class="col-sm-10">
                                    <input type="file" name="featured_image" />
                                    @if ($errors->has('featured_image'))
                                        <span class="text-red">
                                            <strong>{{ $errors->first('featured_image') }}</strong>
                                        </span>
                                    @endif
                                </div>                                
                            </div>
                        @endif                 
                    </div><!-- /.box-body -->

                    <hr>

                    <!-- Products start -->
                    <div class="box-header with-border">
                        <h3 class="box-title">                            
                            Products
                        </h3>
                    </div>                    
                    
                    <div class="box-body">
                        <div class="form-group{{ $errors->has('meta_tags') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Products</label>
                            <div class="col-sm-10">
                                <select multiple="multiple" id="products" name="products[]">                                    
                                    @if( $mode == 'create' )
                                        @foreach( $products as $product )
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    @else
                                        @foreach( $products as $product )
                                            <option value="{{ $product->id }}" @if( in_array($product->id, $added_products) ) selected @endif>{{ $product->name }}</option>
                                        @endforeach
                                    @endif
                                </select>                                
                            </div>                                
                        </div>
                    </div><!-- /.box-body -->
                    <!-- Products End -->

                    <hr>

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

                    <hr>

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
                        <a href="{{ url('admin/collections') }}" class="btn btn-default">Back to Collections List</a>
                        <input type="submit" class="btn btn-info pull-right" name="submit" value="{{ $mode == 'edit' ? 'Update' : 'Create' }}" />
                    </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->

@endsection


@section('scripts')
    <script type="text/javascript">
        $('#products').multiSelect()
    </script>
@endsection