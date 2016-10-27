@extends('site._layouts.default')

@section('content')
    <section class="coffees our-coffees"><!-- coffees -->
        <div class="center">
            <h3>{{ $input['title'] }}</h3>            
            <h4>Author: {{ $user->name }}</h4>    
            <h4>Posted at: {{ date('F, j Y', time()) }}</h4>    
            {!! $input['body'] !!} 
        </div>
    </section><!-- coffees END -->
@endsection