@extends('site._layouts.default')

@section('content')
<div class="body">
  <div class="container">
     <div class="row-fluid margin-bottom-10"> 
            <form class="reg-page" role="form" method="POST" action="{{ url('/login') }}">
                {!! csrf_field() !!}
                <h3>Prijavi se</h3>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"><!-- input line -->
                     @if ($errors->has('email'))
                        <span class="text-error">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                     @endif
                    <label class="col-md-4 control-label">Email adresa</label>
                    <input type="text" class="form-control" name="email" placeholder="Email adresa">
                    
                </div><!-- input line END -->
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}"><!-- input line -->
                    @if ($errors->has('password'))
                        <span class="text-error">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    <label class="col-md-4 control-label">Šifra</label>
                    <input type="password" class="form-control" name="password" placeholder="Šifra">
                       
                </div><!-- input line END -->
                <div class="input-line"><!-- input line -->
                    <a class="form-link" href="{{ url('/password/reset') }}">Zaboravili se šifru?</a>
                </div><!-- input line END -->

                <button type="submit" class="btn-u pull-left" >Prijavi se</button>
            </form>
       </div>
    </div>
</div> 

@endsection


