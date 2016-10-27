@extends('site._layouts.default')

@section('content')
    <section class="how-it-works center"><!-- how it works -->
        <hgroup>
            <h2>How it works</h2>
            <h3>Sed euismod feugiat urna pretium vel</h3>
        </hgroup>
        <figure><img alt="how it works" src="{{ asset('site_assets/images/how-it-works.png') }}" /></figure>
        <p>Cras volutpat cursus rutrum. Sed euismod feugiat urna, at hendrerit quam pretium vel. Ut eu consequat diam. Aenean feugiat velit sapien, id pharetra felis porta eu. Nulla malesuada velit sed nunc rhoncus laoreet. Fusce suscipit sodales nulla, non consectetur orci laoreet a.</p>
        <a class="main-action big" href="{{ url('order_plan') }}">Start Now</a>
    </section><!-- how it works END -->
@endsection