@extends('site._layouts.default')

@section('content')
    <section class="how-it-works center"><!-- how it works -->
        <h3>Already subscribed to another plan</h3>
{{--        <p>Cancel<a href="#"> {{auth()->user()->subscriptions()->lists('stripe_plan')[0]}} </a>plan?</p>--}}
        <p>Cancel<a href="/stripe/cancel-subscription"> {{auth()->user()->subscriptions()->first()->stripe_plan}} </a>plan?</p>
    </section><!-- how it works END -->
@endsection
