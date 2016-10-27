@extends('site._layouts.default')

@section('content')
    <section><!-- step section -->
        <div class="center">
            <div class="steps-indicator"><!-- steps indicator -->
                <div class="select-option1"><img src="{{ asset('site_assets/images/icon-step1.png') }}" /><span>Select Plan</span></div>
                <hr />
                <div class="select-option2 active"><img src="{{ asset('site_assets/images/icon-step2.png') }}" /><span>Choose Coffee</span></div>
                <hr />
                <div class="select-option3"><img src="{{ asset('site_assets/images/icon-step3.png') }}" /><span>Shipping Info</span></div>
            </div><!-- steps indicator END -->
            <h2>SELECT {{ $cart_data->qty }} OF YOUR FAVORITE BOXES</h2>
            <h3>Your plan: {{ $cart_data->qty }} boxes (24ct each) every {{ $cart_data->options->delivery }} ${{ $cart_data->price }}</h3>
        </div>
    </section><!-- step section END -->
    <section class="veriety-pack"><!-- veriety pack -->
        <div class="center">
            <h4>VARIETY PACK</h4>
            @if( $packages )
                @foreach( $packages as $package )
                    <div class="box-pack @if($cart_data->packages && array_key_exists($package->id, $cart_data->packages)) active-packeg @endif"><!-- box pack -->
                        <span>{{ $package->name }} <b class="item_name">@if($cart_data->packages && array_key_exists($package->id, $cart_data->packages)){{ $cart_data->packages[$package->id]['quantity'] }}@endif</b></span>
                        <figure class="pack-option">
                            <img src="{{ asset($package->featured_image) }}" />
                        </figure>                        
                        <a class="add-plus" href="#" data-name="{{ $package->name }}" data-id="{{ $package->id }}" data-type="package" @if( $total_in_cart == $cart_data->qty ) style="display:none;" @endif></a>                        
                        <a class="minus-pack" href="#" data-name="{{ $package->name }}" data-id="{{ $package->id }}" data-type="package" @if($cart_data->packages && array_key_exists($package->id, $cart_data->packages)) @else style="display:none;" @endif></a>                        
                    </div><!-- box pack END -->
                @endforeach
            @endif
        </div>
    </section><!-- veriety pack END -->
    <section class="coffees"><!-- coffees -->
        <div class="center">
            <h4>COFFEES</h4>
            @if( $products )
                @foreach( $products as $product )
                    <div class="box-pack @if($cart_data->products && array_key_exists($product->id, $cart_data->products)) active-packeg @endif"><!-- box pack -->
                        <span>{{ $product->name }} <b class="item_name">@if($cart_data->products && array_key_exists($product->id, $cart_data->products)){{ $cart_data->products[$product->id]['quantity'] }}@endif</b></span>
                        <small>{{ $product->sub_name }}</small>
                        <figure class="pack-option">
                            <?php $images = json_decode(  $product->images, true); ?>
                            <img src="{{ asset($images[0]) }}" />
                        </figure>                        
                        <a class="add-plus" href="#" data-name="{{ $product->name }}" data-id="{{ $product->id }}" data-type="product" @if( $total_in_cart == $cart_data->qty ) style="display:none;" @endif></a>                       
                        <a class="minus-pack" href="#" data-name="{{ $product->name }}" data-id="{{ $product->id }}" data-type="product" @if($cart_data->products && array_key_exists($product->id, $cart_data->products)) @else style="display:none;" @endif></a>
                    </div><!-- box pack END -->
                @endforeach
            @endif
            <div class="clear"></div>
            <div class="continue-box">
                @if( $total_in_cart == $cart_data->qty )
                    <p class="pull-left">You selected {{ $total_in_cart }} items</p>
                @else
                    <p class="pull-left">Please select {{ $cart_data->qty - $total_in_cart }} more boxes to continue</p>
                @endif
                <a class="pull-right main-action {{ ($total_in_cart == $cart_data->qty) ? '' : 'disabled_link' }}" href="{{ url('order_billing') }}">CONTINUE</a>
            </div>
        </div>
    </section><!-- coffees END -->
@endsection