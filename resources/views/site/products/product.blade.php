@extends('site._layouts.default')

@section('content')
    <section class="coffees our-coffees"><!-- coffees -->
        <div class="center">
            <h4>{{ $data->name }}</h4>            
            <h3>{{ $data->sub_name }}</h3>    

            {!! $data->description !!}  

            @if( $data->images )
                <?php $images_list = json_decode($data->images, true); ?>
                @foreach( $images_list as $image )
                    <div class="col-sm-2">
                        <img width="200" src="{{ asset($image) }}" />
                    </div>
                @endforeach
            @endif 
  
        </div>
    </section><!-- coffees END -->
@endsection