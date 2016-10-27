@extends('site._layouts.default')

@section('content')
    <section class="coffees our-coffees"><!-- coffees -->
        <div class="center">
            <h3>{{ $data->title }}</h3>            
            <h4>Author: {{ $data->author->name }}</h4>    
            <h4>Posted at: {{ date('F, j Y', strtotime($data->created_at)) }}</h4>    

            {!! $data->body !!} 

        </div>
    </section><!-- coffees END -->
@endsection