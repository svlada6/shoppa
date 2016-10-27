@extends('site._layouts.default')

@section('content')
    <section class="login-page center">
        <h2>Stripe Dashboard</h2>
        <h4>Stripe details</h4>

        @if(session()->has('message'))
           <p> {{session()->get('message')}}</p>
        @endif

        @if(!is_null($userPlan))
            <p>Stripe plan : </p>
            <div>
                {{$userPlan->stripe_plan}}
            </div>
            @if($userPlan->ends_at == null)
                    <button><a href="/stripe/cancel-subscription">Cancel this stripe plan</a></button>
            @endif

            @if($userPlan->ends_at)
                <div>Ended at:
                    {{$userPlan->ends_at->toFormattedDateString()}}
                </div>
            @endif

        @endif
        <br>  <br>  <br>  <br>  <br>  <br>  <br> <br>  <br>  <br>  <br>  <br>  <br>  <br> <br>  <br>  <br>  <br>  <br>  <br>  <br> <br>  <br>  <br>  <br>  <br>  <br>  <br> <br>  <br>  <br>  <br>  <br>  <br>  <br>
    </section>
@endsection