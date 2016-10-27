@extends('admin._layouts.default')

@section('page_header')
    <h1>
        Create New Account  
    </h1>
@endsection

@section('breadcrumb')
    <li class="active">
        Create New Account
    </li>
@endsection

@section('content')
    <div class="row">
       <div class="col-xs-12">
		<div class="page-header">
			@if (session('status'))
			<div id="order_success" class="alert alert-block {{ session('status') == 'success' ? 'alert-success' : 'alert-danger' }}">
	            <button data-dismiss="alert" class="close" type="button">×</button>
	            {{ session('message') }}
	        </div>
	        @endif
		
		</div>	
       </div>
        <div class="col-xs-12">
            <!-- interactive chart -->
            <div class="box box-primary">
                <!-- form start -->
                <form class="form-horizontal" method="post" action='{{url('admin/account/processUserCreate')}}'>    
                    <div class="box-header with-border">
                        <h3 class="box-title">                            
                                Create New Account
                        </h3>
                    </div>                    
                
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
                        
                         <div class="form-group{{ $errors->has('limit_access') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">limit access rights</label>
                            <div class="col-sm-10">
                                <input  type="checkbox" name="limit_access"   id='limit_access' value=""  />
                                @if ($errors->has('cpassword'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('limit_access') }}</strong>
                                    </span>
                                @endif
                            </div>                                
                        </div>
                        <div class="form-group" id="checkbox_div" style="display:none">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                @foreach($admin_rights as $a_r)
                                    <label> {{ $a_r->name }} </label>
                                    <input  type="checkbox" name="permissions[]"   value="{{$a_r->id}}"  />
                                @endforeach
                            </div>                                
                        </div>
                   

                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ url('admin/accounts') }}" class="btn btn-default">Back to Accounts List</a>
                        <input type="submit" class="btn btn-info pull-right" name="submit" value="Add Account" />
                    </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->

@endsection

@section('scripts')
    <script>
        $('#limit_access').on('click', function(){          
            if($(this).is(":checked"))
                $(this).val(1);
            else
                $(this).val(0);
            
            $('#checkbox_div').toggle();
        });
</script>
@endsection