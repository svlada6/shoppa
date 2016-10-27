@extends('site._layouts.default')

@section('content')
    <section><!-- step section -->
        <div class="center">
            <h2>Blog</h2>
        </div>
    </section><!-- step section END -->
    <section class="veriety-pack"><!-- veriety pack -->
        <div class="center">
            @if( $data )
                @foreach( $data as $item )
                    <h3><a href='{{ url("blog/$item->slug") }}'>{{ $item->title }}</a></h3>
                    <p>Author: {{ $item->author->name }} </p>
                    <p>Posted at: {{ date('F, j Y', strtotime($item->created_at)) }} </p>
                @endforeach
            @endif
        </div>
    </section><!-- veriety pack END -->
@endsection