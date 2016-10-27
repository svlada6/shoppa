@extends('site._layouts.default')

@section('content')
<section class="costrain-form center"><!-- login section -->
 <form method="post" action="{{url('profile/'.$user->id)}}" >
     {!! csrf_field() !!}
      <div class="form-box"><!-- form box -->
                 <h3>Profile Information</h3>
                 <div class="page-header">
			@if (session('status'))
			<div id="order_success" class="alert alert-block {{ session('status') == 'success' ? 'alert-success' : 'alert-danger' }}">
                        <button data-dismiss="alert" class="close" type="button">×</button>
                          {{ session('message') }}
	         </div>
                          @endif
                    <div class="input-line"><!-- input line -->
                        <label for="name">Name</label>
                        <input type="text" value="{{isset($user->name) ? $user->name:old('name')}}" name="name" placeholder="Name">
                         @if ($errors->has('name'))
                            <span class="help-block">
                                <strong class="error">{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-line"><!-- input line -->
                        <label for="email">Email</label>
                        <input type="email" value="{{isset($user->email) ? $user->email:old('email')}}" name="email" placeholder="Email">
                         @if ($errors->has('email'))
                            <span class="help-block">
                                <strong class="error">{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-line"><!-- input line -->
                        <label for="password">Password</label>
                        <input type="password" value="" name="password" placeholder="Password">
                         @if ($errors->has('password'))
                            <span class="help-block">
                                <strong class="error">{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-line"><!-- input line -->
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="text" value="" name="password_confirmation" placeholder="Confirm password">
                         @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong class="error">{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
            
          
        </div><!-- form box END -->
        <button type="submit" class="main-action" href="#">Save</button>
<form>
</section>
@endsection