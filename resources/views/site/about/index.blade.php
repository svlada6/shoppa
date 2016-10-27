@extends('site._layouts.default')

@section('content')
    <div class="inner-header about-header"></div>
    <section class="about-page center"><!-- login section -->
        <h2>Our story</h2>
        <div class="half-content">
            <h4>We are coffee lovers just like you</h4>
            <figure><img src="{{ asset('site_assets/images/about1.png') }}" /></figure>
            <p>Prior to founding The Green Street Coffee Company we frequented coffee shops; ground our own beans; brewed our own coffee; and tried every single-serve coffee maker and coffee on the market we could find.</p>
            <p>While we loved the convenience of single-serve coffee we were dappointed with the quality of coffee that was available in K-Cups. As coscious consumers, we were also concerned about the impact of plastic K-Cups on the environment and the potentially carcinogenic health risks caused by plastic K-Cups. Green Street was formed with the objective to deliver you better quality coffee in the healthiest and most environmentally friendly way possible.  The final challenge was to deliver this to you at a very competitive price.</p>
        </div>
        <div class="half-content">
            <h4>Coffee is best when shared with a friend</h4>
            <figure><img src="{{ asset('site_assets/images/about2.png') }}" /></figure>
            <p>We have developed relationships with the highest quality purveyors of coffee and partnered with the leading manufacturer of K-Cups in the world. In doing so, we have completely cut out multiple “middle men” that traditionally sit between you and your coffee. As a result, we are able to offer you a superior, healthier and more environmentally conscious product at a fraction of the price.</p>
            <p>We are delighted to say that we are only a few months away from having the first and only biodegradable K-Cups on the market. We know you will enjoy our products and thank you for your support.</p>
            <p>Coffee is best when shared with a friend! If you are enjoying our coffee we ask that you tell a friend! When your friend signs up we will send you free month of coffee to say thanks.</p>
        </div>
        <div class="clear"></div>
    </section><!-- login section END -->
@endsection