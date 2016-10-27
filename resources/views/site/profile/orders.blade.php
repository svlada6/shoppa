@extends('site._layouts.default')

@section('content')
<section class="faq-page center"><!-- login section -->
    <h2>Orders History</h2>
    
    @if( $data || $gifts_data )
        @if( $data )
            <h3>Orders</h3>
            <ul class="faq-accordion">
                @foreach( $data as $item )
                <li>
                    <a href="#">Plan: {{ $item->name }} at ${{ $item->price }}</a>
                    <div>
                        <p>Plan Name: {{ $item->name }}</p>
                        <p>Price: ${{ $item->price }}</p>
                        <p>Free Shipping Every: {{ $item->subtotal/$item->price }} months</p>
                        <p>Ordered at: {{ date('F, j Y H:i:s', strtotime($item->created_at)) }}</p>
                        <p>Items in this order:</p>
                        
                        @if( count($item->collections) )
                            <p><b>Packages</b></p>
                            @foreach( $item->collections as $collection )
                                <p>{{ $collection->name }} | Quantity: {{ $collection->pivot->quantity }}</p><br>
                            @endforeach
                        @endif
                        
                        @if( count($item->products) )
                            <p><b>Products</b></p>
                            @foreach( $item->products as $product )
                                @if( $product->pivot->collection == 0 )
                                    <p>{{ $product->name }} | Quantity: {{ $product->pivot->quantity }}</p><br>
                                @endif
                            @endforeach
                        @endif

                        <p><b>Shipping Info:</b></p>
                        <p>Name and Surname: {{ $item->shipping_first_name }} {{ $item->shipping_last_name }}</p>
                        <p>Company: {{ $item->shipping_company }}</p>
                        <p>Shipping Address 1: {{ $item->shipping_address_1 }}</p>
                        <p>Shipping Address 2: {{ $item->shipping_address_2 }}</p>
                        <p>City: {{ $item->shipping_city }}</p>
                        <p>State: {{ $item->shipping_state }}</p>
                        <p>Postal: {{ $item->shipping_postal }}</p>

                    </div>
                </li>
                @endforeach
            </ul>
        @endif

        @if( $gifts_data )
            <h3>Gifts</h3>
            <ul class="faq-accordion">
                @foreach( $gifts_data as $gift )
                <li>
                    <a href="#">Gift: {{ $gift->name }} at ${{ $gift->price }}</a>
                    <div>
                        <p>Gift Name: {{ $gift->name }}</p>
                        <p>Price: ${{ $gift->price }}</p>
                        <p>Ordered at: {{ date('F, j Y H:i:s', strtotime($gift->created_at)) }}</p>
                        <p>Items in this order:</p>
                        
                        @if( count($gift->collections) )
                            <p><b>Packages</b></p>
                            @foreach( $gift->collections as $collection )
                                <p>{{ $collection->name }} | Quantity: {{ $collection->pivot->quantity }}</p><br>
                            @endforeach
                        @endif
                        
                        @if( count($gift->products) )
                            <p><b>Products</b></p>
                            @foreach( $gift->products as $product )
                                @if( $product->pivot->collection == 0 )
                                    <p>{{ $product->name }} | Quantity: {{ $product->pivot->quantity }}</p><br>
                                @endif
                            @endforeach
                        @endif

                        <p><b>Shipping Info:</b></p>
                        <p>Name and Surname: {{ $gift->shipping_first_name }} {{ $gift->shipping_last_name }}</p>
                        <p>Company: {{ $gift->shipping_company }}</p>
                        <p>Shipping Address 1: {{ $gift->shipping_address_1 }}</p>
                        <p>Shipping Address 2: {{ $gift->shipping_address_2 }}</p>
                        <p>City: {{ $gift->shipping_city }}</p>
                        <p>State: {{ $gift->shipping_state }}</p>
                        <p>Postal: {{ $gift->shipping_postal }}</p>
                    </div>
                </li>
                @endforeach
            </ul>
        @endif
    @else
        <p>No orders yet</p>
    @endif

</section>
@endsection