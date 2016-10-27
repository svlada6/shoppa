@extends('site._layouts.default')

@section('content')
    <section><!-- step section -->
        <div class="center">
            <h2>Our Coffees</h2>
        </div>
    </section><!-- step section END -->
    <section class="veriety-pack"><!-- veriety pack -->
        <div class="center">
            <h4>VARIETY PACK</h4>                
            @if( $packages )
                @foreach( $packages as $package )
                    <div class="box-pack"><!-- box pack -->
                        <span>{{ $package->name }}</span>
                        <figure class="pack-option">
                            <img src="{{ asset($package->featured_image) }}" />
                        </figure>
                    </div><!-- box pack END -->
                @endforeach
            @endif
        </div>
    </section><!-- veriety pack END -->
    <section class="coffees our-coffees"><!-- coffees -->
        <div class="center">
            <h4>COFFEES</h4>            
            @if( $products )
                @foreach( $products as $product )
                    <div class="box-pack"><!-- box pack -->
                        <div class="float-info">
                            <span>{{ $product->name }}</span>
                            <small>{{ $product->sub_name }}</small>
                            {!! $product->description !!}
                        </div>
                        <span>{{ $product->name }}</span>
                        <small>{{ $product->sub_name }}</small>
                        <figure class="pack-option">
                            <?php $images = json_decode(  $product->images, true); ?>
                            <img src="{{ asset($images[0]) }}" />
                        </figure>
                    </div><!-- box pack END -->
                @endforeach
            @endif
        </div>
    </section><!-- coffees END -->
@endsection