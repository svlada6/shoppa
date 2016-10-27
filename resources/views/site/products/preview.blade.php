@extends('site._layouts.default')

@section('content')
    <section class="coffees our-coffees"><!-- coffees -->
        <div class="center">
            <h4>{{ $input['name'] }}</h4>            
            <h3>{{ $input['sub_name'] }}</h3>    

            {!! $input['description'] !!}  

            @if( isset($input['uploaded_images']) )
            <figure class="pack-option">
                @foreach( $input['uploaded_images'] as $image )
                    <img width="200" src="{{ asset($image) }}" />
                @endforeach
            </figure>
            @endif  

            @if( isset($input['addimage']) )
            <figure class="pack-option">
                @foreach( $input['addimage'] as $image )
                    <img width="200" src="{{ asset($image) }}" />
                @endforeach
            </figure>
            @endif    
        </div>
    </section><!-- coffees END -->
@endsection