@extends('site._layouts.default')

@section('body_id')
    id="home-page"
@endsection

@section('content')
<body>
<!--=== Style Switcher ===-->    
<i class="style-switcher-btn icon-cogs"></i>
<div class="style-switcher">
    <div class="theme-close"><i class="icon-remove"></i></div>
    <div class="theme-heading">Theme Colors</div>
    <ul class="unstyled">
        <li class="theme-default theme-active" data-style="default" data-header="light"></li>
        <li class="theme-blue" data-style="blue" data-header="light"></li>
        <li class="theme-orange" data-style="orange" data-header="light"></li>
        <li class="theme-red" data-style="red" data-header="light"></li>
        <li class="theme-light" data-style="light" data-header="light"></li>
    </ul>
</div><!--/style-switcher-->
<!--=== End Style Switcher ===-->    

<!--=== Top ===-->  
@if(!Auth::check())
<div class="top">
    <div class="container">			
        <ul class="loginbar pull-right">        	
            <li><a href="{{ url('/public_register') }}" class="login-btn">Registracija</a></li>	
            <li class="devider">&nbsp;</li>
            <li><a href="{{ url('/public_login') }}" class="login-btn">Prijavi se</a></li>	
        </ul>
    </div>		
</div><!--/top-->
<!--=== End Top ===-->
@endif



<!--=== Slider ===-->
<div class="slider-inner">
    <div id="da-slider" class="da-slider">
        <div class="da-slide">
            <h2><i>CLEAN &amp; FRESH</i> <br /> <i>FULLY RESPONSIVE</i> <br /> <i>DESIGN</i></h2>
            <p><i>Lorem ipsum dolor amet</i> <br /> <i>tempor incididunt ut</i> <br /> <i>veniam omnis </i></p>
            <div class="da-img"><img src="{{ asset('front_assets/plugins/parallax-slider/img/1.png')}}" alt="" /></div>
        </div>
        <div class="da-slide">
            <h2><i>RESPONSIVE VIDEO</i> <br /> <i>SUPPORT AND</i> <br /> <i>MANY MORE</i></h2>
            <p><i>Lorem ipsum dolor amet</i> <br /> <i>tempor incididunt ut</i></p>
            <div class="da-img span6">
                <div class="span6">
                    <iframe src="http://player.vimeo.com/video/47911018" width="100%" height="320" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe> 
                </div>
            </div>
        </div>
        <div class="da-slide">
            <h2><i>USING BEST WEB</i> <br /> <i>SOLUTIONS WITH</i> <br /> <i>HTML5/CSS3</i></h2>
            <p><i>Lorem ipsum dolor amet</i> <br /> <i>tempor incididunt ut</i> <br /> <i>veniam omnis </i></p>
            <div class="da-img"><img src="{{ asset('front_assets/plugins/parallax-slider/img/html5andcss3.png')}}" alt="image01" /></div>
        </div>
        <nav class="da-arrows">
            <span class="da-arrows-prev"></span>
            <span class="da-arrows-next"></span>        
        </nav>
    </div><!--/da-slider-->
</div><!--/slider-->
<!--=== End Slider ===-->

<!-- Purchase Block -->
<div class="row-fluid purchase margin-bottom-30">
    <div class="container">
		<div class="span9">
            <span>Unify is a clean and fully responsive incredible Template.</span>
            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi  vehicula sem ut volutpat. Ut non libero magna fusce condimentum eleifend enim a feugiat.</p>
        </div>
        <a href="https://wrapbootstrap.com/theme/unify-responsive-website-template-WB0412697" class="btn-buy hover-effect">Purchase Now</a>
    </div>
</div><!--/row-fluid-->
<!-- End Purchase Block -->

<!-- Content Part -->
<div class="container">
	<!-- Service Blocks -->
	<div class="row-fluid">
    	<div class="span4">
    		<div class="service clearfix">
                <i class="icon-resize-small"></i>
    			<div class="desc">
    				<h4>Fully Responsive</h4>
                    <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus etiam sem...</p>
    			</div>
    		</div>	
    	</div>
    	<div class="span4">
    		<div class="service clearfix">
                <i class="icon-cogs"></i>
    			<div class="desc">
    				<h4>HTML5 + CSS3</h4>
                    <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus etiam sem...</p>
    			</div>
    		</div>	
    	</div>
    	<div class="span4">
    		<div class="service clearfix">
                <i class="icon-plane"></i>
    			<div class="desc">
    				<h4>Launch Ready</h4>
                    <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus etiam sem...</p>
    			</div>
    		</div>	
    	</div>			    
	</div><!--/row-fluid-->
	<!-- //End Service Blocks -->

	<!-- Recent Works -->
	<div class="headline"><h3>Recent Works</h3></div>
    <ul class="thumbnails">
        <li class="span3">
            <div class="thumbnail-style thumbnail-kenburn">
            	<div class="thumbnail-img">
                    <div class="overflow-hidden"><img src="{{ asset('front_assets/img/carousel/2.jpg')}}" alt="" /></div>
                    <a class="btn-more hover-effect" href="#">read more +</a>					
                </div>
                <h3><a class="hover-effect" href="#">Our Work</a></h3>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, justo sit amet risus etiam porta sem.</p>
            </div>
        </li>
        <li class="span3">
            <div class="thumbnail-style thumbnail-kenburn">
            	<div class="thumbnail-img">
                    <div class="overflow-hidden"><img src="{{ asset('front_assets/img/carousel/3.jpg')}}" alt="" /></div>
                    <a class="btn-more hover-effect" href="#">read more +</a>					
                </div>
                <h3><a class="hover-effect" href="#">One More Work</a></h3>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, justo sit amet risus etiam porta sem.</p>
            </div>
        </li>
        <li class="span3">
            <div class="thumbnail-style thumbnail-kenburn">
            	<div class="thumbnail-img">
                    <div class="overflow-hidden"><img src="{{ asset('front_assets/img/carousel/9.jpg')}}" alt="" /></div>
                    <a class="btn-more hover-effect" href="#">read more +</a>					
                </div>
                <h3><a class="hover-effect" href="#">Another Work</a></h3>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, justo sit amet risus etiam porta sem.</p>
            </div>
        </li>
        <li class="span3">
            <div class="thumbnail-style thumbnail-kenburn">
            	<div class="thumbnail-img">
                    <div class="overflow-hidden"><img src="{{ asset('front_assets/img/carousel/10.jpg')}}" alt="" /></div>
                    <a class="btn-more hover-effect" href="#">read more +</a>					
                </div>
                <h3><a class="hover-effect" href="#">Huge Work</a></h3>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, justo sit amet risus etiam porta sem.</p>
            </div>
        </li>
    </ul><!--/thumbnails-->
	<!-- //End Recent Works -->

	<!-- Blockquote Block -->
    <blockquote class="margin-bottom-40">
        <p>Award winning digital agency. We bring a personal and effective approach to every project we work on, which is why. Unify is an incredibly beautiful responsive Bootstrap Template for corporate professionals.</p>
        <small>CEO, Jack Bour</small>
    </blockquote>
	<!--//End Blockquote Block -->

    <!-- Service blocks -->
    <div class="row-fluid servive-block">
        <div class="span4">
            <h4>Lorem sequat ipsum de</h4>
            <p><i class="icon-bell"></i></p>
            <p>Donec id elit non mi porta gravida at eget metus id elit mi egetine. Fusce dapibus, tellus ac cursus comodo egetine metuss gorp.</p>
        </div>
        <div class="span4">
            <h4>Vivamus imperdiet gravi</h4>
            <p><i class="icon-bullhorn"></i></p>
            <p>Donec id elit non mi porta gravida at eget metus id elit mi egetine. Fusce dapibus, tellus ac cursus comodo egetine metuss gorp.</p>
        </div>
        <div class="span4">
            <h4>Donec idslacs elit nomi</h4>
            <p><i class="icon-lightbulb"></i></p>
            <p>Donec id elit non mi porta gravida at eget metus id elit mi egetine. Fusce dapibus, tellus ac cursus comodo egetine metuss gorp.</p>
        </div>
    </div><!--/row-fluid-->
    <!-- //End Service Blokcs -->

	<!-- Recent Works -->
    <div class="headline"><h3>Recent Works</h3></div>
    <div class="row-fluid margin-bottom-40">
        <ul id="list" class="bxslider recent-work">
            <li>
                <a href="#">
                	<em class="overflow-hidden"><img src="{{ asset('front_assets/img/carousel/2.jpg')}}" alt="" /></em>
                    <span>
                        <strong>Happy New Year</strong>
                        <i>Anim pariatur cliche reprehenderit</i>
                    </span>
                </a>
            </li>
            <li>
                <a href="#">
                	<em class="overflow-hidden"><img src="{{ asset('front_assets/img/carousel/9.jpg')}}" alt="" /></em>
                    <span>
                        <strong>Award Winning Agency</strong>
                        <i>Responsive Bootstrap Template</i>
                    </span>
                </a>
            </li>
            <li>
                <a href="#">
                	<em class="overflow-hidden"><img src="{{ asset('front_assets/img/carousel/4.jpg')}}" alt="" /></em>
                    <span>
                        <strong>Wolf Moon Officia</strong>
                        <i>Pariatur prehe cliche reprehrit</i>
                    </span>
                </a>
            </li>
            <li>
                <a href="#">
                	<em class="overflow-hidden"><img src="{{ asset('front_assets/img/carousel/5.jpg')}}" alt="" /></em>
                    <span>
                        <strong>Food Truck Quinoa Nesciunt</strong>
                        <i>Craft labore wes anderson cred</i>
                    </span>
                </a>
            </li>
            <li>
                <a href="#">
                	<em class="overflow-hidden"><img src="{{ asset('front_assets/img/carousel/6.jpg')}}" alt="" /></em>
                    <span>
                        <strong>Happy New Year</strong>
                        <i>Anim pariatur cliche reprehenderit</i>
                    </span>
                </a>
            </li>
            <li>
                <a href="#">
                	<em class="overflow-hidden"><img src="{{ asset('front_assets/img/carousel/7.jpg')}}" alt="" /></em>
                    <span>
                        <strong>Award Winning Agency</strong>
                        <i>Responsive Bootstrap Template</i>
                    </span>
                </a>
            </li>
            <li>
                <a href="#">
                	<em class="overflow-hidden"><img src="{{ asset('front_assets/img/carousel/8.jpg')}}" alt="" /></em>
                    <span>
                        <strong>Wolf Moon Officia</strong>
                        <i>Pariatur prehe cliche reprehrit</i>
                    </span>
                </a>
            </li>
            <li>
                <a href="#">
                	<em class="overflow-hidden"><img src="{{ asset('front_assets/img/carousel/9.jpg')}}" alt="" /></em>
                    <span>
                        <strong>Food Truck Quinoa Nesciunt</strong>
                        <i>Craft labore wes anderson cred</i>
                    </span>
                </a>
            </li>
        </ul>        
	</div><!--/row-->
	<!-- //End Recent Works -->

	<!-- Blockquotes -->
	<div class="row-fluid margin-bottom-30">
        <blockquote class="hero"><!-- add class pagination-centered to center the text-->
            <p>Award winning digital agency. We bring a personal and effective approach to every project we work on, which is why our clients love us and why they keep coming back. Lorem sequat ipsum dolor lorem sit amet, Lorem sequat ipsum dolor lorem sit amet consectetur adipiscing dolor elit.</p>
            <small>CEO, Joe Black</small>
        </blockquote>
	</div><!--/row-fluid-->	
	<!-- //End Blockquotes -->

	<!-- Service blocks -->
	<div class="row-fluid service-alternative"><!-- remove class "service-alternative" to hide green onmouseover effect-->
    	<div class="span4">
    		<div class="service clearfix">
    			<div class="circle">
    				<i class="icon-resize-small"></i>
    			</div>
    			<div class="desc">
    				<h4>Fully Responsive</h4>
                    <p>Lorem ipsum dolor sit amet, Morem ipsum dolor sit amet consectetur adipisicing elit. Award winning digital agency. We bring a personal and effective approach to every project we work on.</p>
    			</div>
    		</div>	
    	</div>
    	<div class="span4">
    		<div class="service clearfix">
    			<div class="circle">
    				<i class="icon-cogs"></i>
    			</div>
    			<div class="desc">
    				<h4>HTML5+CSS3</h4>
                    <p>Lorem ipsum dolor sit amet, Morem ipsum dolor sit amet consectetur adipisicing elit. Award winning digital agency. We bring a personal and effective approach to every project we work on.</p>
    			</div>
    		</div>	
    	</div>
    	<div class="span4">
    		<div class="service clearfix">
    			<div class="circle">
    				<i class="icon-plane"></i>
    			</div>
    			<div class="desc">
    				<h4>Launch Ready</h4>
                    <p>Lorem ipsum dolor sit amet, Morem ipsum dolor sit amet consectetur adipisicing elit. Award winning digital agency. We bring a personal and effective approach to every project we work on.</p>
    			</div>
    		</div>	
    	</div>			    
	</div><!--/row-fluid-->
	<!-- //End Service Blokcs -->

    <!-- Unify Thumbnail -->
    <div class="row-fluid">
        <div class="headline"><h3>Unify Thumbnail</h3></div>
        <ul class="thumbnails">
            <li class="span3 thumbnail-style thumbnail-kenburn">
                <div class="overflow-hidden"><img src="{{ asset('front_assets/img/carousel/7.jpg')}}" alt="" /></div>
                <h3><a href="#">Our Work</a></h3>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, justo sit amet risus etiam porta sem.</p>
                <p><a class="btn-u btn-u-small" href="#">Read more</a></p>
            </li>
            <li class="span3 thumbnail-style thumbnail-kenburn">
                <div class="overflow-hidden"><img src="{{ asset('front_assets/img/carousel/10.jpg')}}" alt="" /></div>
                <h3><a href="#">Our Work</a></h3>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, justo sit amet risus etiam porta sem.</p>
                <p><a class="btn-u btn-u-small" href="#">Read more</a></p>
            </li>
            <li class="span3 thumbnail-style thumbnail-kenburn">
                <div class="overflow-hidden"><img src="{{ asset('front_assets/img/carousel/3.jpg')}}" alt="" /></div>
                <h3><a href="#">Our Work</a></h3>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, justo sit amet risus etiam porta sem.</p>
                <p><a class="btn-u btn-u-small" href="#">Read more</a></p>
            </li>
            <li class="span3 thumbnail-style thumbnail-kenburn">
                <div class="overflow-hidden"><img src="{{ asset('front_assets/img/carousel/6.jpg')}}" alt="" /></div>
                <h3><a href="#">Our Work</a></h3>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, justo sit amet risus etiam porta sem.</p>
                <p><a class="btn-u btn-u-small" href="#">Read more</a></p>
            </li>
        </ul><!--/thumbnails-->
    </div><!--/row-fluid-->

	<!-- Blockquotes -->
	<div class="row-fluid margin-bottom-5">
        <blockquote class="hero pagination-centered">
            <p><em>Award winning digital agency. We bring a personal and effective approach to every project we work on, which is why our clients love us and why they keep coming back. Lorem sequat ipsum dolor lorem sit amet, Lorem sequat ipsum dolor lorem sit amet consectetur adipiscing dolor elit.</em></p>
        </blockquote>
	</div><!--/row-fluid-->	
	<!-- //End Blockquotes -->
           
	<!-- Blockquotes -->
	<div class="row-fluid margin-bottom-5">
        <blockquote class="hero pagination-centered">
        	<h1 class="color-green">Unify is an incredibly beautiful responsive Template</h1>
            <p><em>Award winning digital agency. We bring a personal and effective approach to every project we work on, which is why our clients love us and why they keep coming back. Lorem sequat ipsum dolor lorem sit amet, Lorem sequat ipsum dolor lorem sit amet consectetur adipiscing dolor elit.</em></p>
        </blockquote>
	</div><!--/row-fluid-->	
	<!-- //End Blockquotes -->

	<!-- Information Blokcs -->
	<div class="row-fluid margin-bottom-20">
    	<!-- Who We Are -->
		<div class="span8">
			<div class="headline"><h3>Welcome To UNIFY Template</h3></div>
			<p><img class="pull-left lft-img-margin img-width-200" src="{{ asset('front_assets/img/carousel/6.jpg')}}" alt="" />Unify is an incredibly beautiful responsive Bootstrap Template for corporate and creative professionals. It works on all major web browsers, tablets and phone.</p>	
            <ul class="unstyled">
            	<li><i class="icon-ok color-green"></i> Donec id elit non mi porta gravida</li>
            	<li><i class="icon-ok color-green"></i> Corporate and Creative</li>
            	<li><i class="icon-ok color-green"></i> Responsive Bootstrap Template</li>
            	<li><i class="icon-ok color-green"></i> Corporate and Creative</li>
            </ul><br />

			<p>Unify is an incredibly beautiful responsive Bootstrap Template for corporate and creative professionals. It works on all major web browsers, tablets and phone. Lorem sequat ipsum dolor lorem sit amet, consectetur adipiscing dolor elit. Unify is an incredibly beautiful responsive Bootstrap Template for It works on all major web.</p>	
        </div><!--/span8-->        

    	<!-- Recent Blog Entries -->
		<div class="span4">
            <div class="posts">
                <div class="headline"><h3>Recent Blog Entries</h3></div>
                <dl class="dl-horizontal">
                    <dt><a href="#"><img src="{{ asset('front_assets/img/sliders/elastislide/6.jpg')}}" alt="" /></a></dt>
                    <dd>
                        <p><a href="#">Anim moon officia Unify is an incredibly beautiful responsive Bootstrap Template</a></p> 
                    </dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt><a href="#"><img src="{{ asset('front_assets/img/sliders/elastislide/10.jpg')}}" alt="" /></a></dt>
                    <dd>
                        <p><a href="#">Lorem sequat ipsum dolor lorem sit amet, consectetur adipiscing dolor elit.</a></p> 
                    </dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt><a href="#"><img src="{{ asset('front_assets/img/sliders/elastislide/11.jpg')}}" alt="" /></a></dt>
                    <dd>
                        <p><a href="#">It works on all major web browsers, tablets and lorem sequat ipsum dolor.</a></p> 
                    </dd>
                </dl>
            </div>
		</div><!--/span4-->	
	</div><!--/row-fluid-->	
	<!-- //End Information Blokcs -->

	<!-- Information Blokcs -->
	<div class="row-fluid">
    	<!-- Our Services -->
		<div class="span8">
			<div class="headline"><h3>Our Services</h3></div>
			<div class="row-fluid servive-block">
                <div class="span4">
                    <h4><a href="#">Lorem sequat ipsum</a></h4>
                    <p><i class="icon-bell"></i></p>
                    <p>Donec id elit non mi porta gravida at eget metus id elit mi.</p>
                </div>
                <div class="span4">
                    <h4><a href="#">Vivamus imperdiet</a></h4>
                    <p><i class="icon-bullhorn"></i></p>
                    <p>Donec id elit non mi porta gravida at eget metus id elit mi.</p>
                </div>
                <div class="span4">
                    <h4><a href="#">Donec idslacs elit</a></h4>
                    <p><i class=" icon-lightbulb"></i></p>
                    <p>Donec id elit non mi porta gravida at eget metus id elit mi.</p>
                </div>
            </div><!--/row-fluid-->
        </div><!--/span8-->        
		
        <!-- Latest Shots -->
        <div class="span4">
			<div class="headline"><h3>Latest Shots</h3></div>
			<div id="myCarousel" class="carousel slide">
                <div class="carousel-inner">
                  <div class="item active">
                    <img src="{{ asset('front_assets/img/carousel/5.jpg')}}" alt="" />
                    <div class="carousel-caption">
                      <p>Cras justo odio, dapibus ac facilisis in, egestas.</p>
                    </div>
                  </div>
                  <div class="item">
                    <img src="{{ asset('front_assets/img/carousel/4.jpg')}}" alt="" />
                    <div class="carousel-caption">
                      <p>Cras justo odio, dapibus ac facilisis in, egestas.</p>
                    </div>
                  </div>
                  <div class="item">
                    <img src="{{ asset('front_assets/img/carousel/3.jpg')}}" alt="" />
                    <div class="carousel-caption">
                      <p>Cras justo odio, dapibus ac facilisis in, egestas.</p>
                    </div>
                  </div>
                </div>
                
                <div class="carousel-arrow">
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="icon-angle-left"></i></a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="icon-angle-right"></i></a>
                </div>
			</div>
        </div><!--/span4-->
	</div><!--/row-fluid-->	
	<!-- //End Information Blokcs -->

	<!-- Tabs and Testimonials -->
	<div class="row-fluid margin-bottom-30">
    	<!-- Testimonials -->
		<div class="span4">
			<div class="headline"><h3>Client Testimonals</h3></div>
			<div id="testimonal_carousel" class="carousel slide">
			  <!-- Carousel items -->
			  <div class="carousel-inner">
			    <div class="active item">
			    	<div class="testimonial">
				    	<div class="testimonial-body">
				    		<p>Vivamus imperdiet condimentum diam, eget placerat felis consectetur id. Donec eget orci metus, ac adipiscing nunc. Pellentesque fermentum, ante ac interdum ullamcorper. Donec eget orci metus, ac adipiscing nunc. Pellentesque fermentum, ante ac interdum ullamcorper.</p>
				       		<p>Vivamus imperdiet condimentum diam, eget placerat felis consectetur id. Donec eget orci metus, ac adipiscing nunc.</p>	
				       	</div>
				    	<div class="testimonial-author">
				    		<span class="arrow"></span>
				    		<span class="name">John Smith</span>, CEO, Pixel Ltd. 
				    	</div>
				   	</div>
			    </div><!--/carousel-inner-->

                <!-- Item -->
			    <div class="item">
			    	<div class="testimonial">
				    	<div class="testimonial-body">
				    		<p>Vivamus imperdiet condimentum diam, eget placerat felis consectetur id. Donec eget orci metus, ac adipiscing nunc.</p>	
				    		<p>Vivamus imperdiet condimentum diam, eget placerat felis consectetur id. Donec eget orci metus, ac adipiscing nunc. Pellentesque fermentum, ante ac interdum ullamcorper. Donec eget orci metus, ac adipiscing nunc. Pellentesque fermentum, ante ac interdum ullamcorper.</p>							       		
				       	</div>
				    	<div class="testimonial-author">
				    		<span class="arrow"></span>
				    		<span class="name">Lisa Cooper</span>, Art Director, Loop Inc.
				    	</div>
				   	</div>
			    </div><!--/item-->
			  </div><!--/testimonal_carousel-->
              
              <!-- Carousel nav -->						  
              <div class="testimonal-arrow">
                  <a class="icon-angle-right" href="#testimonal_carousel" data-slide="next"></a> 
                  <a class="icon-angle-left" href="#testimonal_carousel" data-slide="prev"></a>	
              </div>
			</div>			
		</div><!--/span4-->
        
    	<!-- Tabs -->
        <div class="span8">
			<div class="headline"><h3>Content Tabs</h3></div>
            <ul class="nav nav-tabs tabs">
                <li class="active"><a href="#home" data-toggle="tab">Home</a></li>
                <li><a href="#profile" data-toggle="tab">Profile</a></li>
                <li><a href="#messages" data-toggle="tab">Messages</a></li>
                <li><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <!--/tabs-->
            
            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <img class="pull-left lft-img-margin img-width-200" src="{{ asset('front_assets/img/work/work1.jpg')}}" alt="" />
                    <h4>Heading Sample 1</h4>
                    <p>Vivamus imperdiet condimentum diam, eget placerat felis consectetur id. Donec eget orci metus, ac adipiscing nunc.</p>
                    <ul class="unstyled">
                        <li><i class="icon-ok color-green"></i> Corporate and Creative</li>
                        <li><i class="icon-ok color-green"></i> Responsive Bootstrap Template</li>
                        <li><i class="icon-ok color-green"></i> Corporate and Creative</li>
                    </ul>
                    <p><em>Vivamus imperdiet condimentum diam, eget placerat felis consectetur id. Donec eget orci metus, ac adipiscing nunc. Pellentesque fermentum, Vivamus Pellentesque fermentum, ante ac interdum ullamcorper.</em></p>
                </div>
                <div class="tab-pane" id="profile">
                	<h4>Heading Sample 2</h4>
                    <p><img class="pull-left lft-img-margin img-width-200" src="{{ asset('front_assets/img/work/work3.jpg')}}" alt="" /> Vivamus imperdiet condimentum diam, eget placerat felis consectetur id. Donec eget orci metus, ac adipiscing nunc. Pellentesque fermentum, ante ac interdum ullamcorper. Donec eget orci metus, <strong>ac adipiscing nunc.</strong> Vivamus imperdiet condimentum diam, eget placerat felis consectetur id. Donec eget orci metus, ac adipiscing nunc. Pellentesque fermentum, ante ac interdum id. Donec eget orci metus, ac adipiscing nunc. Pellentesque fermentum, ante ac interdum ullamcorper. Donec eget orci metus, ac adipiscing nunc. Pellentesque fermentum, ante ac <strong>interdum ullamcorper.</strong></p>
                </div>
                <div class="tab-pane" id="messages">
                    <h4>Heading Sample 3</h4>
                    <p><img class="pull-right rgt-img-margin img-width-200" src="{{ asset('front_assets/img/work/work2.jpg')}}" alt="" /> <strong>Vivamus imperdiet condimentum diam, eget placerat felis consectetur id.</strong> Donec eget orci metus, Vivamus imperdiet condimentum diam, eget placerat felis consectetur id. Donec eget orci metus, ac adipiscing nunc. Pellentesque fermentum, ante ac interdum ullamcorper. Donec eget orci metus, ac adipiscing nunc. Pellentesque fermentum, consectetur id. Donec eget orci metus, ac adipiscing nunc. <strong>Pellentesque fermentum</strong>, ante ac interdum ullamcorper. Donec eget orci metus, ac adipiscing nunc. Pellentesque fermentum, ante ac interdum ullamcorper.</p>
                </div>
                <div class="tab-pane" id="settings">
                	<h4>Heading Sample 4</h4>
                    <p><img class="pull-right rgt-img-margin img-width-200" src="{{ asset('front_assets/img/work/work4.jpg')}}" alt="" /> <strong>Vivamus imperdiet condimentum diam, eget placerat felis consectetur id.</strong> Donec eget orci metus, Vivamus imperdiet condimentum diam, eget placerat felis consectetur id. Donec eget orci metus, ac adipiscing nunc. Pellentesque fermentum, ante ac interdum ullamcorper. Donec eget orci metus, ac adipiscing nunc. Pellentesque fermentum, consectetur id. Donec eget orci metus, ac adipiscing nunc. <strong>Pellentesque fermentum</strong>, ante ac interdum ullamcorper. Donec eget orci metus, ac adipiscing nunc. Pellentesque fermentum, ante ac interdum ullamcorper.</p>
                </div>
            </div><!--/tab-content-->
        </div><!--/span8-->
	</div>	
	<!--//End Tabs and Testimonials -->

	<!-- Information Blokcs -->
	<div class="row-fluid">
    	<div class="span6">
            <div class="headline"><h3>About Us</h3></div>
            <p><img class="pull-right rgt-img-margin img-width-200" src="{{ asset('front_assets/img/work/work4.jpg')}}" alt="" /> Vivamus imperdiet condimentum diam, eget placerat felis consectetur id. Vivamus imperdiet condimentum diam, eget placerat felis consectetur id.</p>
            <ul class="unstyled">
            	<li><i class="icon-ok color-green"></i> Donec id elit non mi porta gravida</li>
            	<li><i class="icon-ok color-green"></i> Corporate and Creative</li>
            	<li><i class="icon-ok color-green"></i> Responsive Bootstrap Template</li>
            	<li><i class="icon-ok color-green"></i> Corporate and Creative</li>
            </ul><br />
            <p><em>Vivamus imperdiet condimentum diam, eget placerat felis consectetur id. Cras justo odio, dapibus ac facilisis in, egestas eget quam vamus mperdiet condimentum diam, eget placerat felis consectetur id.</em></p>
            <p class="pull-rgt"><a class="btn-u" href="#">Read more</a></p>
        </div><!--/span6-->
    	<div class="span6">
            <div class="headline"><h3>Example carousel</h3></div>
			<div id="myCarousel1" class="carousel slide">
                <div class="carousel-inner">
                  <div class="item active">
                    <img src="{{ asset('front_assets/img/carousel/5.jpg')}}" alt="" />
                    <div class="carousel-caption">
                      <h4>First Thumbnail label</h4>
                      <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta.</p>
                    </div>
                  </div>
                  <div class="item">
                    <img src="{{ asset('front_assets/img/carousel/2.jpg')}}" alt="" />
                    <div class="carousel-caption">
                      <h4>Second Thumbnail label</h4>
                      <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta.</p>
                    </div>
                  </div>
                  <div class="item">
                    <img src="{{ asset('front_assets/img/carousel/3.jpg')}}" alt="" />
                    <div class="carousel-caption">
                      <h4>Third Thumbnail label</h4>
                      <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta.</p>
                    </div>
                  </div>
                </div>
                <div class="carousel-arrow">
                    <a class="left carousel-control" href="#myCarousel1" data-slide="prev"><i class="icon-angle-left"></i></a>
                    <a class="right carousel-control" href="#myCarousel1" data-slide="next"><i class="icon-angle-right"></i></a>
                </div>
          </div>
        </div><!--/span6-->
    </div><!--/row-fluid-->
	<!-- //End Information Blokcs -->

	<!-- Accardion and Posts -->
	<div class="row-fluid">
    	<div class="span7">
			<div class="headline"><h3>Unify Accardion</h3></div>
            <!-- Accardion -->
			<div class="accordion acc-home" id="accordion2">
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                      Anim pariatur cliche reprehenderit
                    </a>
                  </div>
                  <div id="collapseOne" class="accordion-body in collapse" style="height: auto;">
                    <div class="accordion-inner">
                      <p><img class="lft-img-margin pull-left img-width-200" src="{{ asset('front_assets/img/work/work1.jpg')}}" alt="" /> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo.</p>
                    </div>
                  </div>
                </div><!--/accordion-group-->
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                      Nihil anim keffiyeh helvetica
                    </a>
                  </div>
                  <div id="collapseTwo" class="accordion-body collapse" style="height: 0px;">
                    <div class="accordion-inner">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </div>
                  </div>
                </div><!--/accordion-group-->
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                      Brunch 3 wolf moon tempor
                    </a>
                  </div>
                  <div id="collapseThree" class="accordion-body collapse" style="height: 0px;">
                    <div class="accordion-inner">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </div>
                  </div>
                </div><!--/accordion-group-->
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
                      Labore wes anderson cred 
                    </a>
                  </div>
                  <div id="collapseFour" class="accordion-body collapse" style="height: 0px;">
                    <div class="accordion-inner">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </div>
                  </div>
                </div><!--/accordion-group-->
            </div><!--/accardion-->
        </div><!--/span7-->
        
        <!-- Posts -->
        <div class="span5"> 
            <div class="posts">
                <div class="headline"><h3>Recent Blog Entries</h3></div>
                <dl class="dl-horizontal">
                    <dt><a href="#"><img src="{{ asset('front_assets/img/sliders/elastislide/6.jpg')}}" alt="" /></a></dt>
                    <dd>
                        <p><a href="#">Anim moon officia Unify is an incredibly beautiful responsive Bootstrap Template</a></p> 
                    </dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt><a href="#"><img src="{{ asset('front_assets/img/sliders/elastislide/10.jpg')}}" alt="" /></a></dt>
                    <dd>
                        <p><a href="#">Lorem sequat ipsum dolor lorem sunt aliqua put a bird sit amet, consectetur adipiscing dolor elit.</a></p> 
                    </dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt><a href="#"><img src="{{ asset('front_assets/img/sliders/elastislide/11.jpg')}}" alt="" /></a></dt>
                    <dd>
                        <p><a href="#">It works on all major web browsers, tablets and aliqua lorem sequat ipsum dolor.</a></p> 
                    </dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt><a href="#"><img src="{{ asset('front_assets/img/sliders/elastislide/9.jpg')}}" alt="" /></a></dt>
                    <dd>
                        <p><a href="#">Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch.</a></p> 
                    </dd>
                </dl>
            </div>
        </div><!--/span5-->
    </div><!--/row-fluid--> 
	<!-- //End Accardion and Posts-->

    <!-- Our Clients -->
    <div id="clients-flexslider" class="flexslider home clients">
        <div class="headline"><h3>Our Clients</h3></div>    
        <ul class="slides">
            <li>
                <a href="#">
                    <img src="{{ asset('front_assets/img/clients/hp_grey.png')}}" alt="" /> 
                    <img src="{{ asset('front_assets/img/clients/hp.png')}}" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="{{ asset('front_assets/img/clients/igneus_grey.png')}}" alt="" /> 
                    <img src="{{ asset('front_assets/img/clients/igneus.png')}}" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="{{ asset('front_assets/img/clients/vadafone_grey.png')}}" alt="" /> 
                    <img src="{{ asset('front_assets/img/clients/vadafone.png')}}" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="{{ asset('front_assets/img/clients/walmart_grey.png')}}" alt="" /> 
                    <img src="{{ asset('front_assets/img/clients/walmart.png')}}" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="{{ asset('front_assets/img/clients/shell_grey.png')}}" alt="" /> 
                    <img src="{{ asset('front_assets/img/clients/shell.png')}}" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="{{ asset('front_assets/img/clients/natural_grey.png')}}" alt="" /> 
                    <img src="{{ asset('front_assets/img/clients/natural.png')}}" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="{{ asset('front_assets/img/clients/aztec_grey.png')}}" alt="" /> 
                    <img src="{{ asset('front_assets/img/clients/aztec.png')}}" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="{{ asset('front_assets/img/clients/gamescast_grey.png')}}" alt="" /> 
                    <img src="{{ asset('front_assets/img/clients/gamescast.png')}}" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="{{ asset('front_assets/img/clients/cisco_grey.png')}}" alt="" /> 
                    <img src="{{ asset('front_assets/img/clients/cisco.png')}}" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="{{ asset('front_assets/img/clients/everyday_grey.png')}}" alt="" /> 
                    <img src="{{ asset('front_assets/img/clients/everyday.png')}}" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="{{ asset('front_assets/img/clients/cocacola_grey.png')}}" alt="" /> 
                    <img src="{{ asset('front_assets/img/clients/cocacola.png')}}" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="{{ asset('front_assets/img/clients/spinworkx_grey.png')}}" alt="" /> 
                    <img src="{{ asset('front_assets/img/clients/spinworkx.png')}}" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="{{ asset('front_assets/img/clients/shell_grey.png')}}" alt="" /> 
                    <img src="{{ asset('front_assets/img/clients/shell.png')}}" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="{{ asset('front_assets/img/clients/natural_grey.png')}}" alt="" /> 
                    <img src="{{ asset('front_assets/img/clients/natural.png')}}" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="{{ asset('front_assets/img/clients/gamescast_grey.png')}}" alt="" /> 
                    <img src="{{ asset('front_assets/img/clients/gamescast.png')}}" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="{{ asset('front_assets/img/clients/everyday_grey.png')}}" alt="" /> 
                    <img src="{{ asset('front_assets/img/clients/everyday.png')}}" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="{{ asset('front_assets/img/clients/spinworkx_grey.png')}}" alt="" /> 
                    <img src="{{ asset('front_assets/img/clients/spinworkx.png')}}" class="color-img" alt="" />
                </a>
            </li>
        </ul>
    </div><!--/flexslider-->
    <!-- //End Our Clients -->
</div><!--/container-->		
<!-- End Content Part -->


@endsection