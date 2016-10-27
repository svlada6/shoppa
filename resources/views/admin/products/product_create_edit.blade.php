@extends('admin._layouts.default')

@section('page_header')
    <h1>
        @if( $mode == 'edit' )
            Edit Product
        @else
            New Product
        @endif
    </h1>
@endsection

@section('breadcrumb')
    <li class="active">
        @if( $mode == 'edit' )
            Edit Product
        @else
            New Product
        @endif
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <!-- interactive chart -->
            <div class="box box-primary">
                <!-- form start -->
                <form id="myform" class="form-horizontal" method="post" action='{{ $mode == 'edit' ? url("admin/products/$data->id/edit") : "" }}'>
                    <div class="box-header with-border">
                        <h3 class="box-title">                            
                            @if( $mode == 'edit' )
                                Edit {{ $data->title }} Product
                            @else
                                Create New Product
                            @endif
                        </h3>
                    </div>                    
                    {!! csrf_field() !!}                      
                    <div class="box-body">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input id="input_slug" class="form-control" type="text" name="name" value="{{ $mode == 'edit' ? $data->name : old('name') }}" required />
                                @if ($errors->has('name'))
                                    <span class="text-red">
                                        <a href ="#"><strong>{{ $errors->first('name') }}</strong></a>
                                    </span>
                                @endif
                            </div>                                
                        </div>

                        <div class="form-group{{ $errors->has('sub_name') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Sub Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="sub_name" value="{{ $mode == 'edit' ? $data->sub_name : old('sub_name') }}" required />
                                @if ($errors->has('sub_name'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('sub_name') }}</strong>
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

                        <div class="form-group{{ $errors->has('id_type') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Type</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="id_type">
                                    @foreach( $categories as $category )
                                        <option {{ ((isset($data) && ($data->id_type == $category->id)) || (old('id_type') == $category->id)) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('id_type'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('id_type') }}</strong>
                                    </span>
                                @endif
                            </div> 

                            <label class="col-sm-2 control-label">Vendor</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="id_vendor">
                                   @foreach( $vendors as $vendor )
                                        <option {{ ((isset($data) && ($data->id_vendor == $vendor->id)) || (old('id_vendor') == $vendor->id)) ? 'selected' : '' }} value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('id_vendor'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('id_vendor') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div><!-- /.box-body -->

                    <hr>

                    <!-- Inventory & Variants start -->
                    <div class="box-header with-border">
                        <h3 class="box-title">                            
                            Inventory & Variants
                        </h3>
                    </div>                    
                    
                    <div class="box-body">
                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Price</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="price" value="{{ $mode == 'edit' ? $data->price : old('price') }}" />
                                @if ($errors->has('price'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>   

                            <label class="col-sm-2 control-label">Compare at Price</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="compare_price" value="{{ $mode == 'edit' ? $data->compare_price : old('compare_price') }}" />
                                @if ($errors->has('compare_price'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('compare_price') }}</strong>
                                    </span>
                                @endif
                            </div>                             
                        </div>

                        <div class="form-group{{ $errors->has('stock_keeping_unit') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">SKU (Stock Keeping Unit)</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="stock_keeping_unit" value="{{ $mode == 'edit' ? $data->stock_keeping_unit : old('stock_keeping_unit') }}" />
                                @if ($errors->has('stock_keeping_unit'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('stock_keeping_unit') }}</strong>
                                    </span>
                                @endif
                            </div>   

                            <label class="col-sm-2 control-label">Barcode</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="barcode" value="{{ $mode == 'edit' ? $data->barcode : old('barcode') }}" />
                                @if ($errors->has('barcode'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('barcode') }}</strong>
                                    </span>
                                @endif
                            </div>                             
                        </div>                        

                        <div class="form-group{{ $errors->has('multiple_options') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="multiple_options" value="1" {{ ((isset($data) && ($data->multiple_options)) || (old('multiple_options'))) ? 'checked' : '' }}> 
                                        <strong>This product has multiple options</strong> (eg. multiple sizes and/or colors)
                                    </label>
                                </div>
                                @if ($errors->has('multiple_options'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('multiple_options') }}</strong>
                                    </span>
                                @endif
                            </div>                                
                        </div>

                        <div class="form-group{{ $errors->has('in_stock') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">In Stock</label>
                            <div class="col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="in_stock" value="1" {{ ((isset($data) && ($data->in_stock)) || (old('in_stock'))) ? 'checked' : '' }}> 
                                    </label>
                                </div>
                                @if ($errors->has('in_stock'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('in_stock') }}</strong>
                                    </span>
                                @endif
                            </div>                                
                        </div>

                        <div class="form-group{{ $errors->has('on_offer') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">On Offer</label>
                            <div class="col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="on_offer" value="1" {{ ((isset($data) && ($data->on_offer)) || (old('on_offer'))) ? 'checked' : '' }}> 
                                    </label>
                                </div>
                                @if ($errors->has('on_offer'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('on_offer') }}</strong>
                                    </span>
                                @endif
                            </div>                                
                        </div>  
                    </div><!-- /.box-body -->
                    <!-- Inventory & Variants End -->

                    <hr>

                    <!-- Images start -->
                    <div class="box-header with-border">
                        <h3 class="box-title">                            
                            Images
                        </h3>
                    </div>                    
                    
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Images</label>
                            <div class="col-sm-10">
                                <div class="container">
                                    <div class="dropzone" id="dropzoneFileUpload">
                                    </div>
                                </div>
                            </div>                                
                        </div>

                        @if( $mode == 'edit' )
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Uploaded Images</label>
                            <div class="col-sm-10">
                                @if( $data->images )
                                    <?php $images_list = json_decode($data->images, true); ?>
                                    @foreach( $images_list as $image )
                                        <div class="col-sm-2">
                                            <img width="150" height="150" src="{{ asset($image) }}" />
                                            <button class="btn btn-sm btn-danger delete_image" type="button" data-target="{{ url('admin/products/delete_image' ) }}" data-value="{{ $image }}" data-product_id="{{ $data->id }}">Delete</button>
                                            <input type="hidden" name="uploaded_images[]" value="{{ asset($image) }}" />
                                        </div>
                                    @endforeach
                                @endif
                            </div>                                
                        </div>    
                        @endif
                    </div><!-- /.box-body -->
                    <!-- Images End -->

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
                    
                    @if( $mode == 'edit' )
                    <div class="box-body">
                        <div class ="col-xs-1 col-md-2">
                            &nbsp;
                        </div>
                        <div class ="col-xs-11 col-md-10">
  
                            <h4> Search Engine Preview </h4>
 
                        </div>
                        <div class ="col-xs-1 col-md-2">
                            &nbsp;
                        </div>
                        <div class ="col-xs-11 col-md-10">

                            <p><span id ="title" class="text-info lead"> {{ $data->meta_title }} </span><br />
                            <span class="text-success"> {{ url('/admin/products/') }}/</span><span id ="slug" class="text-success">{{ $data->slug }} </span><br />
                            <span id ="description" class = "lead"> {{ $data->meta_description }} </span></p>

                        </div>
                    </div>
                    @endif

                    <div class="box-body">
                        <div class="form-group{{ $errors->has('meta_title') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Page Title</label>
                            <div class="col-sm-10">
                                <input id ="span_title" class="form-control" type="text" name="meta_title" value="{{ $mode == 'edit' ? $data->meta_title : old('meta_title') }}" />
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
                                <input id ="span_description" class="form-control" type="text" name="meta_description" value="{{ $mode == 'edit' ? $data->meta_description : old('meta_description') }}" />
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
                                <input id ="span_slug" class="form-control" type="text" name="name" value="{{ $data->slug }}" disabled />
                            </div>                                
                        </div>
                        @endif
                    </div><!-- /.box-body -->
                    <!-- Search Engines End -->

                    <hr>

                    <!-- Visibility start -->
                    <div class="box-header with-border">
                        <h3 class="box-title">                            
                            Visibility
                        </h3>
                    </div>                    
                    
                    <div class="box-body">
                        <div class="form-group{{ $errors->has('visible_at') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">                               

                                <div class="radio">
                                    <label>
                                        <input type="radio" name="enabled" value="1" {{ ((isset($data) && ($data->visible_at)) || (old('visible_at'))) ? 'checked' : 'checked' }}>
                                        Visible (as of {{ date('Y-m-d H:i:s') }})
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="enabled" value="0" {{ ((isset($data) && ($data->visible_at == '0')) || (old('visible_at') == '0')) ? 'checked' : '' }}>
                                        Hidden
                                    </label>
                                </div>
                            </div> 
                        </div> 


                        <div class="form-group">
                            <label class="col-sm-2 control-label">Specific Publish Date</label>
                            <div class="col-sm-10">                             
                                @if( $mode == 'create' )
                                    <a href="#" id="custom_range">Set a specific publich date...</a>
                                    <div class="input-group" style="display:none;" id="custom_range_data">
                                @else
                                    <div class="input-group">
                                @endif
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="date_publish" name="visible_at" value="{{ $mode == 'edit' ? $data->visible_at : old('visible_at') }}">
                                </div><!-- /.input group -->
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <!-- Visibility End -->                   


                    <div class="box-footer">
                        <a href="{{ url('admin/products') }}" class="btn btn-default">Back to Products List</a>
                        <input type="submit" class="btn btn-info pull-right" name="submit" value="{{ $mode == 'edit' ? 'Update' : 'Create' }}" />
                        <input type="submit" class="btn btn-info" name="preview" id="preview" value="Preview" />
                    </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!-- Delete modal -->
    @include('admin._modals.danger')

@endsection

@section('scripts')
    <script type="text/javascript">
        var baseUrl = "{{ url('/') }}";
        var token = "{{ Session::getToken() }}";
        Dropzone.autoDiscover = false;
         var myDropzone = new Dropzone("div#dropzoneFileUpload", {
             url: baseUrl+"/dropzone/uploadFiles",
             params: {
                _token: token
              }
         });
         Dropzone.options.myAwesomeDropzone = {
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 2, // MB
            addRemoveLinks: true,
            // accept: function(file, done) {
              
            // },
            success: function(file, response){
                console.log(response);
            },
        };

        myDropzone.on("success", function(file,responseText) {
            $('form').append('<input type="hidden" name="addimage[]" value="'+responseText.upload_path+'" />');
        });


        $('#preview').on('click', function(){
            $('#myform').attr('action', "{{ url('admin/products/preview')}}" );
        });



    </script>

@endsection