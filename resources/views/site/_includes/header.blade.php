
<!--        <header class="main-header"> header 
            <div class="center">
                <a class="greenSt-coffee-logo" href="{{ url('/') }}"><img src="{{ asset('site_assets/images/logo.png') }}" /><span>Green St. Coffee</span></a>
                <a class="mobile-nav" href="#"></a>
                <nav class="main-nav"> main nav 
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
                </nav> main nav END 
            </div>
        </header> header END -->

<!--=== Header ===-->
<div class="header">               
    <div class="container"> 
        <!-- Logo -->       
        <div class="logo">                                             
            <a href="index.html"><img id="logo-header" src="{{ asset('front_assets/img/logo1-default.png')}}" alt="Logo" /></a>
        </div><!-- /logo -->        
                                    
        <!-- Menu -->       
        <div class="navbar">                                
            <div class="navbar-inner">                                  
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a><!-- /nav-collapse -->                                  
                <div class="nav-collapse collapse">                                     
                    <ul class="nav top-2">
                        <li class="active">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Home
                                <b class="caret"></b>                            
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="index.html">Option1: Landing Page</a></li>
                                <li><a href="page_home.html">Option2: Header Option</a></li>
                                <li><a href="page_home4.html">Option3: Revolution Slider</a></li>
                                <li><a href="page_home5.html">Option4: Amazing Content</a></li>
                                <li><a href="page_home1.html">Option5: Mixed Content</a></li>
                                <li><a href="page_home2.html">Option6: Content with Sidebar</a></li>
                                <li><a href="page_home3.html">Option7: Aplle Style Slider</a></li>
                                <li class="active"><a href="page_home_all.html">Home All In One</a></li>
                            </ul>
                            <b class="caret-out"></b>                        
                        </li>
                        <li>
                            <a href="" class="dropdown-toggle" data-toggle="dropdown">Pages
                                <b class="caret"></b>                            
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="page_about.html">About Us</a></li>
                                <li><a href="page_services.html">Services</a></li>
                                <li><a href="page_pricing.html">Pricing</a></li>
                                <li><a href="page_coming_soon.html">Coming Soon</a></li>
                                <li><a href="page_faq.html">FAQs</a></li>
                                <li><a href="page_search.html">Search Result</a></li>
                                <li><a href="page_gallery.html">Gallery</a></li>
                                <li><a href="{{ url('/public_register') }}">Registracija</a></li>
                                <li><a href="{{ url('/public_login') }}">Prijavi se</a></li>
                                <li><a href="page_404.html">404</a></li>
                                <li><a href="page_clients.html">Clients</a></li>
                                <li><a href="page_privacy.html">Privacy Policy</a></li>
                                <li><a href="page_terms.html">Terms of Service</a></li>
                                <li><a href="page_column_left.html">2 Columns (Left)</a></li>
                                <li><a href="page_column_right.html">2 Columns (Right)</a></li>
                            </ul>
                            <b class="caret-out"></b>                        
                        </li>
                        <li>
                            <a href="" class="dropdown-toggle" data-toggle="dropdown">Features
                                <b class="caret"></b>                            
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="feature_grid.html">Grid Layout</a></li>
                                <li><a href="feature_typography.html">Typography</a></li>
                                <li><a href="feature_thumbnail.html">Thumbnails</a></li>
                                <li><a href="feature_component.html">Components</a></li>
                                <li><a href="feature_navigation.html">Navigation</a></li>
                                <li><a href="feature_table.html">Tables</a></li>
                                <li><a href="feature_form.html">Forms</a></li>
                                <li><a href="feature_icons.html">Icons</a></li>
                                <li><a href="feature_button.html">Buttons</a></li>
                            </ul>
                            <b class="caret-out"></b>                        
                        </li>
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Portfolio
                                <b class="caret"></b>                            
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="portfolio.html">Portfolio</a></li>
                                <li><a href="portfolio_item.html">Portfolio Item</a></li>
                                <li><a href="portfolio_2columns.html">Portfolio 2 Columns</a></li>
                                <li><a href="portfolio_3columns.html">Portfolio 3 Columns</a></li>
                                <li><a href="portfolio_4columns.html">Portfolio 4 Columns</a></li>
                            </ul>
                            <b class="caret-out"></b>                        
                        </li>
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Blog
                                <b class="caret"></b>                            
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="blog_item.html">Blog Item</a></li>
                                <li><a href="blog_left_sidebar.html">Blog Left Sidebar</a></li>
                                <li><a href="blog_item_left_sidebar.html">Blog Item Left Sidebar</a></li>
                            </ul>
                            <b class="caret-out"></b>                        
                        </li>
                        @if(Auth::check())
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Profil
                                <b class="caret"></b>                            
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('profile') }}"><i class="icon-user"></i> Nalog</a></li>
                                <li><a href="{{ url('logout') }}"><i class="icon-signout"></i> Odjavi se</a></li>
                            </ul>
                            <b class="caret-out"></b>                        
                        </li>
                        @endif
                        <li><a class="search"><i class="icon-search search-btn"></i></a></li>                               
                    </ul>
                    <div class="search-open">
                        <div class="input-append">
                            <form />
                                <input type="text" class="span3" placeholder="Search" />
                                <button type="submit" class="btn-u">Go</button>
                            </form>
                        </div>
                    </div>
                </div><!-- /nav-collapse -->                                
            </div><!-- /navbar-inner -->
        </div><!-- /navbar -->                          
    </div><!-- /container -->               
</div><!--/header -->      
<!--=== End Header ===-->