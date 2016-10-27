@extends('admin._layouts.default')

@section('page_header')
    <h1>
        @if( $mode == 'edit' )
            Edit Plan
        @else
            New Plan
        @endif
    </h1>
@endsection

@section('breadcrumb')
    <li class="active">
        @if( $mode == 'edit' )
            Edit Plan
        @else
            New Plan
        @endif
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <!-- interactive chart -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        @if( $mode == 'edit' )
                            Edit {{ $data->name }} Plan
                        @else
                            Create New Plan
                        @endif
                    </h3>
                </div>
                <!-- form start -->
                <form class="form-horizontal" method="post" action='{{ $mode == 'edit' ? url("admin/plan/$data->id/edit") : "" }}' enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="box-body">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="name" value="{{ $mode == 'edit' ? $data->name : old('name') }}"  />
                                @if ($errors->has('name'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('cups_amount') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Cups amount</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="cups_amount" value="{{ $mode == 'edit' ? $data->cups_amount : old('cups_amount') }}" required />
                                @if ($errors->has('cups_amount'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('cups_amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('price_per_cup') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Price per cup</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="price_per_cup" value="{{ $mode == 'edit' ? $data->price_per_cup : old('price_per_cup') }}" required />
                                @if ($errors->has('price_per_cup'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('price_per_cup') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('discount') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Discount</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="discount" value="{{ $mode == 'edit' ? $data->price_per_cup : old('discount') }}" required />
                                @if ($errors->has('price_per_cup'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('discount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Price</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="price" value="{{ $mode == 'edit' ? $data->price : old('price') }}" required />
                                @if ($errors->has('price'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('shipping_plan') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Shipping plan</label>
                            <div class="col-sm-10">
                                
                                {{ Form::select("shipping_plan", ["1 month"=>"1 month", "2 month"=>"2 month", "3 month"=>"3 month"], ($mode == 'edit') ? $data->shipping_plan : "1 month", ["class"=>"form-control"]) }}
                                
                                @if ($errors->has('shipping_plan'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('shipping_plan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        @if($mode == 'edit')
                            <div class="form-group">
                                <div class="col-sm-2 text-right"><label class="col-sm-2 control-label "></label>
                                </div>
                                <div class="col-sm-10">
                                    <img width="200px" src="{{asset('uploads/plans/'.$data->id .'/'.$data->featured_image)}}">
                                </div>
                            </div>
                        @endif


                        <div class="form-group{{ $errors->has('featured_image') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Image</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" name="featured_image" value="{{ $mode == 'edit' ? $data->name : old('featured_image') }}"  />
                                @if ($errors->has('featured_image'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('featured_image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ url('admin/plans') }}" class="btn btn-default">Back to Plans</a>
                        <input type="submit" class="btn btn-info pull-right" name="submit" value="{{ $mode == 'edit' ? 'Update' : 'Create' }}" />
                    </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection