@extends('admin._layouts.default')

@section('page_header')
    <h1>
        @if( $mode == 'edit' )
            Edit FAQ
        @else
            New FAQ
        @endif
    </h1>
@endsection

@section('breadcrumb')
    <li class="active">
        @if( $mode == 'edit' )
            Edit FAQ
        @else
            New FAQ
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
                            Edit {{ $data->name }} FAQ
                        @else
                            Create New FAQ
                        @endif
                    </h3>
                </div>                    
                <!-- form start -->
                <form class="form-horizontal" method="post" action='{{ $mode == 'edit' ? url("admin/faqs/$data->id/edit") : "" }}'>
                    {!! csrf_field() !!}                      
                    <div class="box-body">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Question</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="name" value="{{ $mode == 'edit' ? $data->name : old('name') }}" required />
                                @if ($errors->has('name'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>                                
                        </div>
                        <div class="form-group{{ $errors->has('category_name') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">FAQ Category</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="faq_category_id">
                                    @foreach( $categories as $category )
                                        <option {{ ((isset($data) && ($data->faq_category_id == $category->id)) || (old('faq_category_id') == $category->id)) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('faq_category_id'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('faq_category_id') }}</strong>
                                    </span>
                                @endif
                            </div>                                
                        </div>
                        <div class="form-group{{ $errors->has('category_name') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">FAQ Answer</label>
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
                    <div class="box-footer">
                        <a href="{{ url('admin/faqs') }}" class="btn btn-default">Back to FAQ's List</a>
                        <input type="submit" class="btn btn-info pull-right" name="submit" value="{{ $mode == 'edit' ? 'Update' : 'Create' }}" />
                    </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection