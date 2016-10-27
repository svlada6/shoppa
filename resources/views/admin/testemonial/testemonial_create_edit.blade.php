@extends('admin._layouts.default')

@section('page_header')
    <h1>
        @if( $mode == 'edit' )
            Edit Testemonial
        @else
            New Testemonial
        @endif
    </h1>
@endsection

@section('breadcrumb')
    <li class="active">
        @if( $mode == 'edit' )
            Edit Testemonial
        @else
           New Testemonial
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
                            Edit {{ $data->name }} Testemonial
                        @else
                            Create New Testemonial
                        @endif
                    </h3>
                </div>                    
                <!-- form start -->
                <form class="form-horizontal" method="post" action='{{ $mode == 'edit' ? url("admin/testemonials/$data->id/edit") : "" }}'>
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
                        
                             <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                                    <label class="col-sm-2 control-label">Content</label>
                                    <div class="col-sm-10">
                                         <textarea id="editor1" name="body" rows="10" cols="80">
                                                     {{$mode == 'edit' ? $data->body : old('body')}}
                                         </textarea>
                                        @if ($errors->has('content'))
                                            <span class="text-red">
                                                <strong>{{ $errors->first('body') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                            </div>
                           <div class="form-group">
                            <label class="col-sm-2 control-label">Status type</label>
                            <div class="col-sm-10">
                    
                                    {{ Form::select('enable', $enable_type, isset($data->enabled) ? $data->enabled:1, ['class' => 'form-control']) }}
                                @if ($errors->has('enable'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('enable') }}</strong>
                                    </span>
                                @endif
                            </div>                                
                        </div>
                      
           
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ url('admin/testemonials') }}" class="btn btn-default">Back to Testemonial's List</a>
                        <input type="submit" class="btn btn-info pull-right" name="submit" value="{{ $mode == 'edit' ? 'Update' : 'Create' }}" />
                    </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection