@extends('site._layouts.default')

@section('content')
    <section class="login-page center"><!-- login section -->
        <div class="form-box login-box">
            <h2>Reset Password</h2>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                {!! csrf_field() !!}
                <div class="input-line{{ $errors->has('email') ? ' has-error' : '' }}"><!-- input line -->
                    <input type="text" name="email" placeholder="Email" value="{{ old('email') }}">
                     @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                     @endif
                </div><!-- input line END --> 

                <div class="input-line{{ $errors->has('email') ? ' has-error' : '' }}"><!-- input line -->
                    <input type="password" name="password" placeholder="Password" value="">
                     @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                     @endif
                </div><!-- input line END --> 

                <div class="input-line{{ $errors->has('email') ? ' has-error' : '' }}"><!-- input line -->
                    <input type="password" name="password" placeholder="Confrim Password" value="">
                     @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                     @endif
                </div><!-- input line END -->           
        </div>
        <button type="submit" class="main-action" >Reset</button>
        </form>
    </section><!-- login section END -->
@endsection