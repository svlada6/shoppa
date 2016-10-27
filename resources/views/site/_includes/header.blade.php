
        <header class="main-header"><!-- header -->
            <div class="center">
                <a class="greenSt-coffee-logo" href="{{ url('/') }}"><img src="{{ asset('site_assets/images/logo.png') }}" /><span>Green St. Coffee</span></a>
                <a class="mobile-nav" href="#"></a>
                <nav class="main-nav"><!-- main nav -->
                    <ul>
                        <li><a @if(Request::is('about')) class="green-text" @endif href="{{ url('about') }}">About</a></li>
                        <li><a @if(Request::is('faq')) class="green-text" @endif href="{{ url('faq') }}">FAQ</a></li>                   
                        <li><a @if(Request::is('coffees')) class="green-text" @endif href="{{ url('coffees') }}">Our Coffee</a></li>
                        <li><a @if(Request::is('how-it-works')) class="green-text" @endif href="{{ url('how-it-works') }}">How it Works</a></li>
                        <li><a @if(Request::is('testemonials_list')) class="green-text" @endif href="{{ url('testemonials_list') }}">Testemonials</a></li>
                        {{--<li><a @if(Request::is('stripe_review')) class="green-text" @endif href="{{ url('stripe/stripe_review') }}">Stripe Details</a></li>--}}
                        
                        @if (Auth::check())
                            <li id="dropdown_li">
                                <ul class="nav navbar-nav navbar-right">
                                    <li class="dropdown">
                                        <a href="#"  id="aaa" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                            Welcome {{ Auth::user()->name }} <span class="caret"></span>
                                        </a>

                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ url('profile') }}"><i class="fa fa-btn fa-user"></i>Profile</a></li>
                                            <li><a href="{{ url('testemonials') }}"><i class="fa fa-btn fa-sign-out"></i>Testemonials</a></li>
                                            <li><a href="{{ url('shipping') }}"><i class="fa fa-btn fa-sign-out"></i>Shipping</a></li>
                                            <li><a href="{{ url('billing') }}"><i class="fa fa-btn fa-sign-out"></i>Billing</a></li>
                                            <li><a href="{{ url('dashboard') }}"><i class="fa fa-btn fa-user"></i>Dashboard</a></li>
                                            <li><a href="{{ url('orders') }}"><i class="fa fa-btn fa-envelope"></i>Order history</a></li>
                                            <li><a href="{{ url('stripe/stripe_review') }}"><i class="fa fa-btn fa-envelope"></i>Subscription</a></li>
                                            <li><a href="{{ url('logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                                        </ul>
                                    </li>
                                  </ul>
                            </li>
                        @else
                            <li><a href="{{ url('/public_login') }}">Login</a></li>
                            <li><a href="{{ url('/public_register') }}">Register</a></li>
                        @endif                                               
                    </ul>
                </nav><!-- main nav END -->
            </div>
        </header><!-- header END -->