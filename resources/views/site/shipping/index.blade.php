@extends('site._layouts.default')

@section('content')
<section class="costrain-form center"><!-- login section -->
 <form method="post" action="{{url('shipping/'.Auth::user()->id)}}" >
     {!! csrf_field() !!}
      <div class="form-box"><!-- form box -->
                 <h3>Shipping Information</h3>
                 <div class="page-header">
			@if (session('status'))
			<div id="order_success" class="alert alert-block {{ session('status') == 'success' ? 'alert-success' : 'alert-danger' }}">
                        <button data-dismiss="alert" class="close" type="button">×</button>
                          {{ session('message') }}
	         </div>
                          @endif
                    <div class="input-line"><!-- input line -->
                        <div class="half {{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name">First name</label>
                            <input type="text" name="first_name" placeholder="First name" value="{{isset($user->first_name) ? $user->first_name:old('first_name')}}">
                             @if ($errors->has('first_name'))
                                <span class="help-block">
                                    <strong class="error">{{ $errors->first('first_name') }}</strong>
                                </span>
                             @endif
                        </div>
                        <div class="half {{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name">Last name</label>
                            <input type="text" value="{{isset($user->last_name) ? $user->last_name:old('last_name')}}"  name="last_name" placeholder="Last name">
                              @if ($errors->has('last_name'))
                                <span class="help-block">
                                    <strong class="error">{{ $errors->first('last_name') }}</strong>
                                </span>
                             @endif
                        </div>
                    </div><!-- input line END -->
                    <div class="input-line"><!-- input line -->
                        <label for="company">Company</label>
                        <input type="text" name="company" value="{{isset($user->company) ? $user->company:old('company')}}"  placeholder="Company (optional)">

                    </div><!-- input line END -->
                    <div class="input-line"><!-- input line -->
                        <label for="address_1">Address 1</label>
                        <input type="text" value="{{isset($user->address_1) ? $user->address_1:old('address_1')}}" name="address_1" placeholder="Address 1">
                         @if ($errors->has('address_1'))
                            <span class="help-block">
                                <strong class="error">{{ $errors->first('address_1') }}</strong>
                            </span>
                        @endif
                    </div><!-- input line END -->
                    <div class="input-line"><!-- input line -->
                        <label for="address_2">Address 2</label>
                        <input type="text" value="{{isset($user->address_2) ? $user->address_2:old('address_2')}}" name="address_2" placeholder="Address 2 (optional)">
                    </div><!-- input line END -->
                    <div class="input-line"><!-- input line -->

                      
                        <div class="third {{ $errors->has('city') ? ' has-error' : '' }}">
                              <label for="city">City</label>
                            <input type="text"  value="{{isset($user->city) ? $user->city:old('city')}}" name="city" placeholder="City">
                             @if ($errors->has('city'))
                            <span class="help-block">
                                <strong class="error">{{ $errors->first('city') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="third">
                             <label for="state">State</label>
                           {{ Form::select('state', $states , isset($user->state) ? $user->state:old('state'),[]) }}
                        </div>
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <div class="third {{ $errors->has('postal') ? ' has-error' : '' }}">
                            <label for="postal">Postal</label>
                            <input type="text" value="{{isset($user->postal) ? $user->postal:old('postal')}}"  name="postal" placeholder="ZIP Code">
                             @if ($errors->has('postal'))
                                <span class="help-block">
                                    <strong class="error">{{ $errors->first('postal') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div><!-- input line END -->
        </div><!-- form box END -->
        <button type="submit" class="main-action" href="#">Save</button>
<form>
</section>
@endsection