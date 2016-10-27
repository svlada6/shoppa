@extends('site._layouts.default')

@section('body_id')
    id="home-page"
@endsection

@section('content')
    <section class="home-promo"><!-- promo -->
        <div class="center promo-mesage">
            <h1>Presen atenim <span>Cras a tincidunt libero</span></h1>
            <a class="main-action big" href="{{ url('order_plan') }}">Start Now</a>
        </div>
        <div class="social-home-wraper">
            <div class="center social-display">
                <div class="pull-left">fb</div>
                <div class="pull-right">twitter</div>
            </div>
        </div>
    </section><!-- promo END -->
    <section class="how-it-works center"><!-- how it works -->
        <hgroup>
            <h2>How it works</h2>
            <h3>Sed euismod feugiat urna pretium vel</h3>
        </hgroup>
        <figure><img alt="how it works" src="{{ asset('site_assets/images/how-it-works.png') }}" /></figure>
        <p>Cras volutpat cursus rutrum. Sed euismod feugiat urna, at hendrerit quam pretium vel. Ut eu consequat diam. Aenean feugiat velit sapien, id pharetra felis porta eu. Nulla malesuada velit sed nunc rhoncus laoreet. Fusce suscipit sodales nulla, non consectetur orci laoreet a.</p>
        <a class="main-action big" href="{{ url('order_plan') }}">Start Now</a>
    </section><!-- how it works END -->
    <section class="coffee-story"><!-- coffee story -->
        <div class="center">
            <div class="half-content"><!-- hafl content -->
                <h4>Our Story</h4>
                <p>Etiam ac sodales sem, sed mattis velit. Aenean laoreet dictum tortor eu faucibus. Duis ut erat eu elit varius condimentum. Vestibulum mi arcu, vestibulum at blandit eu, euismod non ex</p>
                <figure><img src="{{ asset('site_assets/images/icon-story.png') }}" /></figure>
            </div><!-- hafl content END -->
            <div class="half-content"><!-- hafl content -->
                <h4>Coffee News</h4>
                <p>Etiam ac sodales sem, sed mattis velit. Aenean laoreet dictum tortor eu faucibus. Duis ut erat eu elit varius condimentum. Vestibulum mi arcu, vestibulum at blandit eu, euismod non ex</p>
                <figure><img src="{{ asset('site_assets/images/icon-news.png') }}" /></figure>
            </div><!-- hafl content END -->
            <div class="clear"></div>
        </div>
    </section><!-- coffee story END -->
@endsection