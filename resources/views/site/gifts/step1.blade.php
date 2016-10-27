@extends('site._layouts.default')

@section('content')
    <section><!-- step section -->
        <div class="center">
            <div class="steps-indicator"><!-- steps indicator -->
                <div class="select-option1 active"><img src="{{ asset('site_assets/images/icon-step1.png') }}" /><span>Select Plan</span></div>
                <hr />
                <div class="select-option2"><img src="{{ asset('site_assets/images/icon-step2.png') }}" /><span>Choose Coffee</span></div>
                <hr />
                <div class="select-option3"><img src="{{ asset('site_assets/images/icon-step3.png') }}" /><span>Shipping Info</span></div>
            </div><!-- steps indicator END -->
            <h2>SELECT YOUR ONE-TIME GIFT OPTION</h2>
            <div class="coffee-ofers">

                <div class="options option1"><!-- option 1 -->
                    <div class="iner-wraper">
                        <div class="title">
                            <h5>48 <small>CUPS</small></h5>
                            <div class="box-tag"><!-- box tag -->
                                <small>as low as</small>
                                <span>$.49</span>
                                <small>per cup</small>
                            </div><!-- box tag END -->
                        </div>
                        <figure class="product-img"><img src="{{ asset('site_assets/images/coffee-box1.jpg') }}" /></figure>
                        <div class="price-wrap"><!-- price wrap -->
                            <span class="totoal-price">$24.<sub>95</sub></span>
                        </div><!-- price wrap END -->
                        <div class="shiping-frequency"><!-- shiping frequency -->
                            <h6>Free Shipping</h6>
                        </div><!-- shiping frequency END -->
                    </div>
                    <a class="main-action" href="{{ url('gift_packages') }}" data-name="48 Cups" data-price="24.95" data-packs="2" data-id="1" data-type="gift_package">select this option <span>PICK YOUR COFFEES</span></a>
                </div><!-- option 1 END -->

                <div class="options option2"><!-- option 1 -->
                    <div class="iner-wraper">
                        <div class="title">
                            <h5>72 <small>CUPS</small></h5>
                            <div class="box-tag"><!-- box tag -->
                                <small>as low as</small>
                                <span>$.48</span>
                                <small>per cup</small>
                            </div><!-- box tag END -->
                        </div>
                        <figure class="product-img"><img src="{{ asset('site_assets/images/coffee-box1.jpg') }}" /></figure>
                        <div class="price-wrap"><!-- price wrap -->
                            <span class="totoal-price">$34.<sub>95</sub></span>
                        </div><!-- price wrap END -->
                        <div class="shiping-frequency"><!-- shiping frequency -->
                            <h6>Free Shipping</h6>
                        </div><!-- shiping frequency END -->
                    </div>
                    <a class="main-action" href="{{ url('gift_packages') }}" data-name="72 Cups" data-price="34.95" data-packs="3" data-id="2" data-type="gift_package">select this option <span>PICK YOUR COFFEES</span></a>
                </div><!-- option 1 END -->

                <div class="options option3"><!-- option 1 -->
                    <div class="iner-wraper">
                        <div class="title">
                            <h5>96 <small>CUPS</small></h5>
                            <div class="box-tag"><!-- box tag -->
                                <small>as low as</small>
                                <span>$.46</span>
                                <small>per cup</small>
                            </div><!-- box tag END -->
                        </div>
                        <figure class="product-img"><img src="{{ asset('site_assets/images/coffee-box1.jpg') }}" /></figure>
                        <div class="price-wrap"><!-- price wrap -->
                            <span class="totoal-price">$44.<sub>95</sub></span>
                        </div><!-- price wrap END -->
                        <div class="shiping-frequency"><!-- shiping frequency -->
                            <h6>Free Shipping</h6>
                        </div><!-- shiping frequency END -->
                    </div>
                    <a class="main-action" href="{{ url('gift_packages') }}" data-name="96 Cups" data-price="44.95" data-packs="4" data-id="3" data-type="gift_package">select this option <span>PICK YOUR COFFEES</span></a>
                </div><!-- option 1 END -->

                <div class="options option3"><!-- option 1 -->
                    <div class="iner-wraper">
                        <div class="title">
                            <h5>192 <small>CUPS</small></h5>
                            <div class="box-tag"><!-- box tag -->
                                <small>as low as</small>
                                <span>$.39</span>
                                <small>per cup</small>
                            </div><!-- box tag END -->
                        </div>
                        <figure class="product-img"><img src="{{ asset('site_assets/images/coffee-box1.jpg') }}" /></figure>
                        <div class="price-wrap"><!-- price wrap -->
                            <span class="totoal-price">$74.<sub>95</sub></span>
                        </div><!-- price wrap END -->
                        <div class="shiping-frequency"><!-- shiping frequency -->
                            <h6>Free Shipping</h6>
                        </div><!-- shiping frequency END -->
                    </div>
                    <a class="main-action" href="{{ url('gift_packages') }}" data-name="96 Cups" data-price="74.95" data-packs="8" data-id="3" data-type="gift_package">select this option <span>PICK YOUR COFFEES</span></a>
                </div><!-- option 1 END -->


            </div>
        </div>
    </section><!-- step section END -->

@endsection