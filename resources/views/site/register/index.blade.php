@extends('site._layouts.default')

@section('content')
    <!--=== Content Part ===-->
    <div class="body">
        <div class="container">		
            <div class="row-fluid margin-bottom-10">
                <form class="reg-page" role="form" method="POST" action="{{ url('/register') }}" />
                {!! csrf_field() !!}
                <h3>Registruj novi nalog</h3>
                <div class="controls input-line">   
                     @if ($errors->has('email'))
                        <span class="text-error">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                     @endif
                    <label>Ime i prezime <span class="color-red">*</span></label>
                    <input type="text" class="span12" value="{{old('name')}}"  name="name" placeholder="Ime" />
                     @if ($errors->has('email'))
                        <span class="text-error">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                     @endif
                    <label>Email adresa <span class="color-red">*</span></label>
                    <input type="text" class="span12" value="{{old('email')}}" name="email" placeholder="Email" />
               
                    @if ($errors->has('password'))
                        <span class="text-error">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    <label>Šifra <span class="color-red">*</span></label>
                    <input  class="span12" type="password" name="password" placeholder="Šifra" />                                   
                    @if ($errors->has('password_confirmation'))
                        <span class="text-error">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                    <label>ponovi šifru <span class="color-red">*</span></label>
                    <input class="span12" type="password" name="password_confirmation" placeholder="Potvrdi šifru" />

                <hr />
                <p>Već registrovani? <a href="{{ url('/public_login') }}" class="color-green">Prijavi se</a> da bi se ulogovali.</p>
                <button class="btn-u pull-right" type="submit">Registruj se</button>
                </form>
            </div><!--/row-fluid-->
        </div><!--/container-->		
    </div><!--/body-->

@endsection

