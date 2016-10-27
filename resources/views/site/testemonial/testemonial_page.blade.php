@extends('site._layouts.default')

@section('content')
    <section class="faq-page"><!-- login section -->
        <h2>Testemonials</h2>


        @foreach( $data as $item )

            <h4>{{$item->name}}</h4>
           <center> <p>{!!$item->body !!}</p> </center>
            
        @endforeach
       
        {!! $data->render() !!}
    </section><!-- login section END -->
@endsection