@extends('site._layouts.default')

@section('content')
    <div></div>
    <section class="about-page center"><!-- login section -->
        <h2>{{ $data->title }}</h2>
        <p>
            {{ $data->body }}
        </p>
        <div class="clear"></div>
    </section><!-- login section END -->
@endsection