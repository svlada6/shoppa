@extends('site._layouts.default')

@section('content')
    <section class="login-page center"><!-- login section -->
        <div class="form-box login-box">
            <h2>Register</h2>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                {!! csrf_field() !!}
                <div class="input-line{{ $errors->has('name') ? ' has-error' : '' }}"><!-- input line -->
                    <input type="text" value="{{old('name')}}"  name="name" placeholder="Name">
                     @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                     @endif
                </div><!-- input line END -->
                <div class="input-line{{ $errors->has('email') ? ' has-error' : '' }}"><!-- input line -->
                    <input type="text" value="{{old('email')}}" name="email" placeholder="Email">
                     @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                     @endif
                </div><!-- input line END -->
                <div class="input-line{{ $errors->has('password') ? ' has-error' : '' }}"><!-- input line -->
                    <input type="password" name="password" placeholder="Password">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                </div>
               <div class="input-line{{ $errors->has('password_confirmation') ? ' has-error' : '' }}"><!-- input line -->
                    <input type="password" name="password_confirmation" placeholder="Confirm Password">
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                </div><!-- input line END -->
          

        </div>
        <button type="submit" class="main-action" >Register</button>
        </form>
    </section><!-- login section END -->
@endsection

