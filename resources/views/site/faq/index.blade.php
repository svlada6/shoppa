@extends('site._layouts.default')

@section('content')
    <section class="faq-page"><!-- login section -->
        <h2>F A Q</h2>
        
        @foreach( $data as $item )
            <h3>{{ $item->category_name }}</h3>
            
            @if( $item->getFaqList )
                <ul class="faq-accordion">
                    @foreach( $item->getFaqList as $faq )
                        @if( $faq->enabled )
                            <li>
                                <a href="#">{{ $faq->name }}</a>
                                <div>
                                    <p>{!! $faq->body !!}</p>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            @endif
            
        @endforeach
    </section><!-- login section END -->
@endsection