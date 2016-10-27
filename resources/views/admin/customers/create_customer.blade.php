@extends('admin._layouts.default')

@section('page_header')
    <h1>
        Create New Customer
    </h1>
@endsection

@section('breadcrumb')
    <li class="active">
        Create New Customer
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <!-- interactive chart -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">                            
                        Create New Customer
                    </h3>
                </div>                    
                <!-- form start -->
                <form class="form-horizontal" method="post" action='{{url('admin/customers/processUserCreate')}}'>
                    {!! csrf_field() !!}                      
                    <div class="box-body">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="name" value="{{ old('name')}}" required />
                                @if ($errors->has('name'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>                                
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="email" name="email"  value="{{ old('email')}}"  required />
                                @if ($errors->has('email'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>                                
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" name="password"  value="{{ old('password')}}"  required />
                                @if ($errors->has('password'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>                                
                        </div>
                          <div class="form-group{{ $errors->has('cpassword') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Confirm password</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" name="cpassword"   value="{{ old('cpassword')}}" required />
                                @if ($errors->has('cpassword'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('cpassword') }}</strong>
                                    </span>
                                @endif
                            </div>                                
                        </div>
                       <div class="form-group">
                            <label class="col-sm-2 control-label">Account type</label>
                            <div class="col-sm-10">
                    
                                    {{ Form::select('role', $roles_type, null, ['class' => 'form-control']) }}
                                @if ($errors->has('cpassword'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('cpassword') }}</strong>
                                    </span>
                                @endif
                            </div>                                
                        </div>
                        
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ url('admin/customers') }}" class="btn btn-default">Back to Customers List</a>
                        <input type="submit" class="btn btn-info pull-right" name="submit" value="Add Account" />
                    </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->   
@endsection