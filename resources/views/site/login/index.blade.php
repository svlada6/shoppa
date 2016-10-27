@extends('site._layouts.default')

@section('content')
    <section class="login-page center"><!-- login section -->
        <div class="form-box login-box">
            <h2>Login</h2>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                {!! csrf_field() !!}
                <div class="input-line{{ $errors->has('email') ? ' has-error' : '' }}"><!-- input line -->
                    <input type="text" name="email" placeholder="Email">
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
                </div><!-- input line END -->
                <div class="input-line"><!-- input line -->
                    <a class="form-link" href="{{ url('/password/reset') }}">forgot your password?</a>
                </div><!-- input line END -->
            
        </div>
        <button type="submit" class="main-action" >Login</button>
        </form>
    </section><!-- login section END -->
@endsection