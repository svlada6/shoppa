@extends('site._layouts.default')

@section('content')
    <section><!-- step section -->
        <div class="center">
            <div class="steps-indicator"><!-- steps indicator -->
                <div class="select-option1"><img src="{{ asset('site_assets/images/icon-step1.png') }}" /><span>Select Plan</span></div>
                <hr />
                <div class="select-option2"><img src="{{ asset('site_assets/images/icon-step2.png') }}" /><span>Choose Coffee</span></div>
                <hr />
                <div class="select-option3 active"><img src="{{ asset('site_assets/images/icon-step3.png') }}" /><span>Shipping Info</span></div>
            </div><!-- steps indicator END -->
   
      
            {!! csrf_field() !!}
            <div class="content-page">
                @if(Auth::check())
                <div class="form-box"><!-- form box -->
                <form id="shipping_form" method="post" action="{{url('gift_step3')}}" >
                    <h3>To / Shipping Address</h3>
                    <div class="input-line"><!-- input line -->
                        <div class="half {{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <input id="shipping_first_name" type="text" id="cname" value="{{old('first_name')}}"  name="first_name" placeholder="First name" >
                             @if ($errors->has('first_name'))
                                <span class="help-block">
                                    <strong class="error">{{ $errors->first('first_name') }}</strong>
                                </span>
                             @endif
                        </div>
                        <div class="half {{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <input id="shipping_last_name" type="text" value="{{old('last_name')}}"   name="last_name" placeholder="Last name">
                              @if ($errors->has('last_name'))
                                <span class="help-block">
                                    <strong class="error">{{ $errors->first('last_name') }}</strong>
                                </span>
                             @endif
                        </div>
                    </div><!-- input line END -->
                    <div class="input-line"><!-- input line -->
                        <input id="shipping_company" type="text" value="{{old('company')}}" name="company" placeholder="Company (optional)">
                       
                    </div><!-- input line END -->
                    <div class="input-line"><!-- input line -->
                        <input id="shipping_address_1" type="text" value="{{old('address_1')}}"  required  name="address_1" placeholder="Address 1">
                         @if ($errors->has('address_1'))
                            <span class="help-block">
                                <strong class="error">{{ $errors->first('address_1') }}</strong>
                            </span>
                        @endif
                    </div><!-- input line END -->
                    <div class="input-line"><!-- input line -->
                        <input id="shipping_address_2" type="text" value="{{old('address_2')}}" name="address_2" placeholder="Address 2 (optional)">
                    </div><!-- input line END -->
                    <div class="input-line"><!-- input line -->
                        <div class="third {{ $errors->has('city') ? ' has-error' : '' }}">
                            <input id="shipping_city" value="{{old('city')}}" type="text" name="city" required placeholder="City">
                             @if ($errors->has('city'))
                            <span class="help-block">
                                <strong class="error">{{ $errors->first('city') }}</strong>
                            </span>
                            @endif
                        </div>


                        <div class="third">
                           {{ Form::select('state', $states , old('state'), ['id'=>"shipping_state"]) }}
                        </div>
                        <div class="third {{ $errors->has('postal') ? ' has-error' : '' }}">
                            <input id="shipping_postal"  value="{{old('postal')}}" type="text" name="postal" placeholder="Postal">
                             @if ($errors->has('postal'))
                                <span class="help-block">
                                    <strong class="error">{{ $errors->first('postal') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                    </div><!-- input line END -->
                </form>
                </div><!-- form box END -->
                
                       

                <div id="billing_div" class="form-box" ><!-- form box -->
                    <form id="billing_form"  method="post" action="{{url('gift_step3')}}" >
                        <h3>From</h3>
                        <div class="input-line"><!-- input line -->
                            <div class="half {{ $errors->has('from_first_name') ? ' has-error' : '' }}">
                                <input id="from_first_name" type="text" id="cname" value="{{old('from_first_name')}}"  name="from_first_name" placeholder="First name" >
                                 @if ($errors->has('from_first_name'))
                                    <span class="help-block">
                                        <strong class="error">{{ $errors->first('from_first_name') }}</strong>
                                    </span>
                                 @endif
                            </div>
                            <div class="half {{ $errors->has('from_last_name') ? ' has-error' : '' }}">
                                <input id="from_last_name" type="text" value="{{old('from_last_name')}}" name="from_last_name" placeholder="Last name">
                                @if ($errors->has('from_last_name'))
                                    <span class="help-block">
                                        <strong class="error">{{ $errors->first('from_last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><!-- input line END -->
                        <div class="input-line"><!-- input line -->
                            <input id="from_email" type="text" value="{{old('from_email')}}" name="from_email" placeholder="Email">
                            @if ($errors->has('from_email'))
                                <span class="help-block">
                                    <strong class="error">{{ $errors->first('from_email') }}</strong>
                                </span>
                            @endif
                        </div><!-- input line END -->
                        <div class="input-line"><!-- input line -->
                            <textarea id="gift_note" name="gift_note" placeholder="Your Gift Note">{{old('gift_note')}}</textarea>
                             @if ($errors->has('gift_note'))
                                <span class="help-block">
                                    <strong class="error">{{ $errors->first('gift_note') }}</strong>
                                </span>
                            @endif
                        </div><!-- input line END -->

                        <input  id="billing_first_name" type="hidden" value="{{isset($billing->first_name) ? $billing->first_name:old('first_name')}}"  name="first_name">
                        <input id="billing_last_name" type="hidden" value="{{isset($billing->last_name) ? $billing->last_name:old('last_name')}}" name="last_name">
                        <input id="billing_company" type="hidden" value="{{isset($billing->company) ? $billing->company:old('company')}}" name="company">
                        <input id="billing_address_1" type="hidden" value="{{isset($billing->address_1) ? $billing->address_1:old('address_1')}}" name="address_1">
                        <input id="billing_address_2" type="hidden" value="{{isset($billing->address_2) ? $billing->address_2:old('address_2')}}" name="address_2">
                        <input id="billing_city" value="{{isset($billing->city) ? $billing->postal:old('city')}}" type="hidden" name="city">
                        <input id="billing_state" value="{{isset($billing->state) ? $billing->state:old('stat')}}" type="hidden" name="state">
                        <input id="billing_postal" value="{{isset($billing->postal) ? $billing->first_name:old('postal')}}" type="hidden" name="postal">                
                    </form>
                </div><!-- form box END -->
                
            @else                    
                <div class="form-box"><!-- form box -->
                    <h3>Create Your Account</h3>
                    <div class="input-line {{ $errors->has('name') ? ' has-error' : '' }}" ><!-- input line -->
                        <input type="text" value="{{old('name')}}"  name="name" placeholder="Enter your name">
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong class="error">{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div><!-- input line END -->
                    <div class="input-line"><!-- input line -->
                        <input type="text" value="{{old('email')}}"  name="email" placeholder="Enter your email address">
                         @if ($errors->has('email'))
                            <span class="help-block">
                                <strong class="error">{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div><!-- input line END -->
                    <div class="input-line"><!-- input line -->
                        <input type="password" name="password" placeholder="Choose a password">
                    </div>
                    <input type="hidden"  name="new_user" value="true">
                    <div class="input-line"><!-- input line -->
                        <input type="password" name="c_password" placeholder="Confirm password">
                    </div>
                    <!-- input line END -->
                </div><!-- form box END -->
            @endif
        
            <div class="form-box"><!-- form box -->
                <form action="{{url('stripeTest')}}"  style="display:none" method="POST" id="payment-form">
                    <span class="payment-errors"></span>
                    {{csrf_field()}}
                    <input type="hidden" data-key="{{env('STRIPE_KEY')}}">
                    <div class="form-row">
                        <label>
                            <span>Card Number</span>
                            <input name="field" id="field" type="text" size="20" data-stripe="number"/>
                        </label>
                    </div>

                    <div class="input-line"><!-- input line -->
                        <div class="third">
                           <label>
                                <span>CVC</span>
                                <input type="text" size="4" data-stripe="cvc"/>
                             </label>
                        </div>

                        <div class="third">
                           <label>
                             <span>Expiration (MM/YYYY)</span>
                                 <input type="text" size="2" data-stripe="exp-month"/>
                            </label>                          
                        </div>
                        <span> / </span>
                        <div class="third">                          
                            <input type="text" size="4" data-stripe="exp-year"/>
                        </div>                        
                    </div><!-- input line END -->

                    <div class="form-row">                       
                    </div>

                    <div class="form-row">                      
                    </div>
                </form>
            </div>                
            <button type="button" id="continue" class="main-action" href="#">Continue</button>
        </div>


            





            <div class="left-sidebar"><!-- left sidebar -->
                <div class="sidebar-box summary"><!-- sidebar box -->
                    <h3>Summary</h3>
                    <div class="your-plan"><!-- your plan -->
                        <div class="plan-title">Your Plan <a href="{{ url('gift_plan') }}">Edit</a></div>
                        <ul class="data-infolist">
                            <li><span class="data-title">Quantity</span><span class="list-data">{{ $cart_data->qty }} boxes</span></li>
                            <li><span class="data-title">Shipping</span><span class="list-data">{{ $cart_data->options->delivery }}</span></li>
                            <li><span class="data-title">Amount</span><span class="list-data">${{ $cart_data->price }}</span></li>
                        </ul>
                    </div><!-- your plan END -->
                    <div class="your-plan"><!-- your plan -->
                        <div class="plan-title">Your Coffees <a href="{{ url('gift_packages') }}">Edit</a></div>
                        <ul class="data-infolist">
                            @if( $cart_data->packages )
                                @foreach( $cart_data->packages as $package )
                                   <li><span class="data-title">{{ $package['quantity'] }} Box</span><span class="list-data">{{ $package['name'] }}</span></li> 
                                @endforeach
                            @endif
                            @if( $cart_data->products )
                                @foreach( $cart_data->products as $products )
                                   <li><span class="data-title">{{ $products['quantity'] }} Box</span><span class="list-data">{{ $products['name'] }}</span></li> 
                                @endforeach
                            @endif
                        </ul>
                    </div><!-- your plan END -->
                </div><!-- sidebar box END -->
                <div class="sidebar-box satisfaction-100"><!-- satisfaction -->
                    <h2>100%</h2>
                    <h3>Satisfaction</h3>
                    <p>We stand behind everything we sell. If you are not satisfied with your purchase, you can return it for a replacement or refund within 60 days of your purchase.</p>
                    <img src="{{ asset('site_assets/images/stamp-100.png') }}" />
                </div><!-- satisfaction END -->
            </div><!-- left sidebar END -->
            <div class="clear"></div>
        </div>
    </section><!-- step section END -->
@endsection

@section('scripts')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script>

    var payment_flag = 0;
   
    $(function() 
    {

        Stripe.setPublishableKey("{!! env('STRIPE_KEY')!!}");
        var stripeResponseHandler = function(status, response) 
        {
            var $form = $('#payment-form');

            if (response.error) 
            {
                // Show the errors on the form
                $form.find('.payment-errors').text(response.error.message);
                $form.find('button').prop('disabled', false);
            } 
            else 
            {
                // token contains id, last4, and card type
                var token = response.id;
                // Insert the token into the form so it gets submitted to the server
                // var $theEmail = $('<input type="hidden" name="stripeEmail" />').val(res.email);
                $form.append($('<input type="hidden" name="shipping_first_name" />').val($('#shipping_first_name').val()));
                $form.append($('<input type="hidden" name="shipping_last_name" />').val($('#shipping_last_name').val()));
                $form.append($('<input type="hidden" name="shipping_company" />').val($('#shipping_company').val()));
                $form.append($('<input type="hidden" name="shipping_address_1" />').val($('#shipping_address_1').val()));
                $form.append($('<input type="hidden" name="shipping_address_2" />').val($('#shipping_address_2').val()));
                $form.append($('<input type="hidden" name="shipping_city" />').val($('#shipping_city').val()));
                $form.append($('<input type="hidden" name="shipping_state" />').val($('#shipping_state').val()));
                $form.append($('<input type="hidden" name="shipping_postal" />').val($('#shipping_postal').val()));
                $form.append($('<input type="hidden" name="shipping_state" />').val($('#shipping_state').val()));


                $form.append($('<input type="hidden" name="billing_first_name" />').val($('#billing_first_name').val()));
                $form.append($('<input type="hidden" name="billing_last_name" />').val($('#billing_last_name').val()));
                $form.append($('<input type="hidden" name="billing_company" />').val($('#billing_company').val()));
                $form.append($('<input type="hidden" name="billing_address_1" />').val($('#billing_address_1').val()));
                $form.append($('<input type="hidden" name="billing_address_2" />').val($('#billing_address_2').val()));
                $form.append($('<input type="hidden" name="billing_city" />').val($('#billing_city').val()));
                $form.append($('<input type="hidden" name="billing_state" />').val($('#billing_state').val()));
                $form.append($('<input type="hidden" name="billing_postal" />').val($('#billing_postal').val()));
                $form.append($('<input type="hidden" name="billing_state" />').val($('#billing_state').val()));
                $form.append($('<input type="hidden" name="same_billing" />').val(0));

                $form.append($('<input type="hidden" name="from_first_name" />').val($('#from_first_name').val()));
                $form.append($('<input type="hidden" name="from_last_name" />').val($('#from_last_name').val()));
                $form.append($('<input type="hidden" name="from_email" />').val($('#from_email').val()));
                $form.append($('<input type="hidden" name="gift_note" />').val($('#gift_note').val()));
                $form.append($('<input type="hidden" name="is_gift" />').val(1));
                
                $form.append($('<input type="hidden" name="stripeToken" />').val(token));
            
                $form.get(0).submit();
            }
        };

    
        $("#continue").click(function(e) 
        {           
            $( "#shipping_form" ).validate({
                rules: {              
                    first_name: "required",
                    last_name:"required",
                    address_1: "required",
                    city:"required",
                    postal: "required" 
                }
            });

            var shipping = $( "#shipping_form" ).valid();


            $( "#billing_form" ).validate({
                rules: {
                    from_first_name: "required",
                    from_last_name:"required",
                    from_email: "required"
                }
            });

            var billing = $("#billing_form").valid(); 

      
            if(shipping && billing)
            {     
                $("#payment-form").show();
                proccess_payment();
                payment_flag = 1;
            }
            else
            {
               $("#payment-form").hide();
            }
        });


        function proccess_payment()
        {        
            if(payment_flag  ==1)
            {
                var $form = $('#payment-form');
                // Disable the submit button to prevent repeated clicks
                $form.find('button').prop('disabled', true);
                Stripe.card.createToken($form, stripeResponseHandler);
            }
        }

    });
   
</script>
@endsection