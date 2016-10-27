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
            <h2>SELECT YOUR COFFEE QUANTITY</h2>
            <div class="coffee-ofers">

                <div class="options option1"><!-- option 1 -->
                    <div class="iner-wraper">
                        <div class="title">
                            <h5>24 <small>CUPS</small></h5>
                            <div class="box-tag"><!-- box tag -->
                                <small>as low as</small>
                                <span>$.51</span>
                                <small>per cup</small>
                            </div><!-- box tag END -->
                        </div>
                        <figure class="product-img"><img src="{{ asset('site_assets/images/coffee-box1.jpg') }}" /></figure>
                        <div class="price-wrap"><!-- price wrap -->
                            <span class="price-tag">save 25%</span>
                            <span class="totoal-price">$19.<sub>95</sub></span>
                        </div><!-- price wrap END -->
                        <div class="shiping-frequency"><!-- shiping frequency -->
                            <h6>Free Shipping Every:</h6>
                            <select class="shipping_interval">
                                <option value="Every month FREE">1 month</option>
                                <option value="Every 2 months FREE">2 month</option>
                                <option value="Every 3 months FREE">3 month</option>
                            </select>
                        </div><!-- shiping frequency END -->
                    </div>
                    <a class="main-action" href="{{ url('order_packages') }}" data-name="24 Cups" data-price="19.95" data-packs="1" data-id="1" data-type="standard_package">select this plan <span>PICK YOUR COFFEES</span></a>
                </div><!-- option 1 END -->

                <div class="options option2"><!-- option 1 -->
                    <div class="iner-wraper">
                        <div class="title">
                            <h5>48 <small>CUPS</small></h5>
                            <div class="box-tag"><!-- box tag -->
                                <small>as low as</small>
                                <span>$.48</span>
                                <small>per cup</small>
                            </div><!-- box tag END -->
                        </div>
                        <figure class="product-img"><img src="{{ asset('site_assets/images/coffee-box1.jpg') }}" /></figure>
                        <div class="price-wrap"><!-- price wrap -->
                            <span class="price-tag">save 30%</span>
                            <span class="totoal-price">$44.<sub>95</sub></span>
                        </div><!-- price wrap END -->
                        <div class="shiping-frequency"><!-- shiping frequency -->
                            <h6>Free Shipping Every:</h6>
                            <select class="shipping_interval">
                                <option value="Every month FREE">1 month</option>
                                <option value="Every 2 months FREE">2 month</option>
                                <option value="Every 3 months FREE">3 month</option>
                            </select>
                        </div><!-- shiping frequency END -->
                    </div>
                    <a class="main-action" href="{{ url('order_packages') }}" data-name="48 Cups" data-price="44.95" data-packs="2" data-id="2" data-type="standard_package">select this plan <span>PICK YOUR COFFEES</span></a>
                </div><!-- option 1 END -->

                <div class="options option3"><!-- option 1 -->
                    <div class="iner-wraper">
                        <div class="title">
                            <h5>96 <small>CUPS</small></h5>
                            <div class="box-tag"><!-- box tag -->
                                <small>as low as</small>
                                <span>$.74</span>
                                <small>per cup</small>
                            </div><!-- box tag END -->
                        </div>
                        <figure class="product-img"><img src="{{ asset('site_assets/images/coffee-box1.jpg') }}" /></figure>
                        <div class="price-wrap"><!-- price wrap -->
                            <span class="price-tag">save 40%</span>
                            <span class="totoal-price">$74.<sub>95</sub></span>
                        </div><!-- price wrap END -->
                        <div class="shiping-frequency"><!-- shiping frequency -->
                            <h6>Free Shipping Every:</h6>
                            <select class="shipping_interval">
                                <option value="Every month FREE">1 month</option>
                                <option value="Every 2 months FREE">2 month</option>
                                <option value="Every 3 months FREE">3 month</option>
                            </select>
                        </div><!-- shiping frequency END -->
                    </div>
                    <a class="main-action" href="{{ url('order_packages') }}" data-name="96 Cups" data-price="74.95" data-packs="3" data-id="3" data-type="standard_package">select this plan <span>PICK YOUR COFFEES</span></a>
                </div><!-- option 1 END -->

                <div class="options option4"><!-- option 1 -->
                    <div class="iner-wraper">
                        <div class="title">
                            <h5>24 <small>CUPS</small></h5>
                            <div class="box-tag"><!-- box tag -->
                                <small>as low as</small>
                                <span>$.51</span>
                                <small>per cup</small>
                            </div><!-- box tag END -->
                        </div>
                        <figure class="product-img"><img src="{{ asset('site_assets/images/coffee-box1.jpg') }}" /></figure>
                        <div class="price-wrap"><!-- price wrap -->
                            <span class="singles">12 Single Cups</span>
                            <span class="totoal-price">$5.<sub>95</sub></span>
                        </div><!-- price wrap END -->
                        <div class="shiping-frequency free-shiping"><!-- shiping frequency -->
                            <h6>FREE SHIPPING: <span>LIMITED TIME TRIAL</span></h6>
                        </div><!-- shiping frequency END -->
                    </div>
                    <a class="main-action action-height" href="{{ url('order_billing') }}" data-name="Sample Package" data-price="5.95" data-packs="1" data-id="4" data-type="sample_package">select this plan</a>
                </div><!-- option 1 END -->

            </div>
        </div>
    </section><!-- step section END -->

@endsection