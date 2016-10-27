@extends('site._layouts.default')

@section('content')
    <section class="contact-page center">
        <h2>Contact Us</h2>
        <div class="image-promo half-content">
            <h3>Our Coffee</h3>
            <div class="contact-our-coffees">
                <figure><img src="{{ asset('site_assets/images/contact-coffee.jpg') }}" /></figure>
                <p class="caption">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sem ligula, tempor at est id, faucibus vestibulum augue. Etiam lobortis interdum velit eu iaculis. Integer consectetur est ac ante interdum.</p>
            </div>
        </div>
        <div class="half-content">
            <h3>leave us a note</h3>
            {!! Form::open(['url' => 'contact_us', 'method' => 'post']) !!}
            <div class="form-box">
                <div class="input-line">
                    <input type="text" name="name" placeholder="Your Name" value="@if(isset($data['name'])){!! $data['name'] !!}@endif">
                    <p class="error">@if(isset($errors)){{ $errors->first('name') }}@endif</p>
                </div>
                <div class="input-line">
                    <input type="text" name="email" placeholder="Your Email" value="@if(isset($data['email'])){!! $data['email'] !!}@endif">
                    <p class="error">@if(isset($errors)){{ $errors->first('email') }}@endif</p>
                </div>
                <div class="input-line">
                    <textarea name="comment" placeholder="Comments">@if(isset($data['comment'])){!! $data['comment'] !!}@endif</textarea>
                    <p class="error">@if(isset($errors)){{ $errors->first('comment') }}@endif</p>
                </div>
                @if(isset($msg) && ($msg != ''))<p style="color:green;">{!! $msg !!}</p>@endif
                {!! Form::button('Send', ['type' => 'submit', 'class' => 'main-action small-action pull-right']) !!}
            </div>
            {!! Form::close() !!}
        </div>
        <div class="clear"></div>
    </section>
@endsection