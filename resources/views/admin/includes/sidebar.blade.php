<!-- Left side column. contains the logo and sidebar -->

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
     
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
       
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
          @inject('helper', 'App\Helpers\Helper')
          
            @if($helper->check(Config::get('constants.MENU_DASHBOARD'),Config::get('constants.BACKEND_ADMIN')))            
                <li>
                    <a href="{{ url('/admin/dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li> 
            @endif

            @if($helper->check(Config::get('constants.MENU_FAQ'),Config::get('constants.BACKEND_ADMIN')))
                <li class="treeview @if(Request::is('admin/faqs*')) active @endif">
                    <a href="#">
                        <i class="fa fa-edit"></i> <span>FAQ's</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li @if(Request::is('admin/faqs')) class="active" @endif><a href="{{ url('admin/faqs') }}"><i class="fa fa-list"></i> FAQ's List</a></li>
                        <li @if(Request::is('admin/faqs/create')) class="active" @endif><a href="{{ url('admin/faqs/create') }}"><i class="fa fa-pencil"></i> New FAQ</a></li>
                    </ul>
                </li>
            @endif

            @if($helper->check(Config::get('constants.MENU_FAQ_CATEGORIES'),Config::get('constants.BACKEND_ADMIN')))
                <li class="treeview @if(Request::is('admin/faq_categories*')) active @endif">
                    <a href="#">
                        <i class="fa fa-edit"></i> <span>FAQ Categories</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li @if(Request::is('admin/faq_categories')) class="active" @endif><a href="{{ url('admin/faq_categories') }}"><i class="fa fa-list"></i> Categories List</a></li>
                        <li @if(Request::is('admin/faq_categories/create')) class="active" @endif><a href="{{ url('admin/faq_categories/create') }}"><i class="fa fa-pencil"></i> New FAQ Category</a></li>
                    </ul>
                </li>
            @endif

            @if($helper->check(Config::get('constants.MENU_PAGES'),Config::get('constants.BACKEND_ADMIN')))            
                <li class="treeview @if(Request::is('admin/pages*')) active @endif">
                    <a href="#">
                        <i class="fa fa-edit"></i> <span>Pages</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li @if(Request::is('admin/pages')) class="active" @endif><a href="{{ url('admin/pages') }}"><i class="fa fa-list"></i> Pages List</a></li>
                        <li @if(Request::is('admin/pages/create')) class="active" @endif><a href="{{ url('admin/pages/create') }}"><i class="fa fa-pencil"></i> New Page</a></li>
                    </ul>
                </li>
            @endif

            @if($helper->check(Config::get('constants.MENU_POSTS'),Config::get('constants.BACKEND_ADMIN')))
                <li class="treeview @if(Request::is('admin/posts*')) active @endif">
                    <a href="#">
                        <i class="fa fa-edit"></i> <span>Blog Posts</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li @if(Request::is('admin/posts')) class="active" @endif><a href="{{ url('admin/posts') }}"><i class="fa fa-list"></i> Blog Posts List</a></li>
                        <li @if(Request::is('admin/posts/create')) class="active" @endif><a href="{{ url('admin/posts/create') }}"><i class="fa fa-pencil"></i> New Blog Post</a></li>
                    </ul>
                </li>
            @endif

            @if($helper->check(Config::get('constants.MENU_POSTS_CATEGORIES'),Config::get('constants.BACKEND_ADMIN')))
                <li class="treeview @if(Request::is('admin/post_category*')) active @endif">
                    <a href="#">
                        <i class="fa fa-edit"></i> <span>Post Categories List</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li @if(Request::is('admin/post_category')) class="active" @endif><a href="{{ url('admin/post_category') }}"><i class="fa fa-list"></i> Post Categories List</a></li>
                        <li @if(Request::is('admin/post_category/create')) class="active" @endif><a href="{{ url('admin/post_category/create') }}"><i class="fa fa-pencil"></i> New Category</a></li>
                    </ul>
                </li>
            @endif

            @if($helper->check(Config::get('constants.MENU_PRODUCTS'),Config::get('constants.BACKEND_ADMIN')))
                <li class="treeview @if(Request::is('admin/product_vendors*') || Request::is('admin/product_types*') || Request::is('admin/products*')) active @endif">
                    <a href="#">
                        <i class="fa fa-list-alt"></i> <span>Products</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li @if(Request::is('admin/products*')) class="active" @endif>
                            <a href="#"><i class="fa fa-circle-o"></i> Products <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                <li @if(Request::is('admin/products')) class="active" @endif><a href="{{ url('admin/products') }}"><i class="fa fa-list"></i> Products List</a></li>
                                <li @if(Request::is('admin/products/create')) class="active" @endif><a href="{{ url('admin/products/create') }}"><i class="fa fa-pencil"></i> New Product</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="treeview-menu">
                        <li @if(Request::is('admin/product_vendors*')) class="active" @endif>
                            <a href="#"><i class="fa fa-circle-o"></i> Product Vendors <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                <li @if(Request::is('admin/product_vendors')) class="active" @endif><a href="{{ url('admin/product_vendors') }}"><i class="fa fa-list"></i> Vendors List</a></li>
                                <li @if(Request::is('admin/product_vendors/create')) class="active" @endif><a href="{{ url('admin/product_vendors/create') }}"><i class="fa fa-pencil"></i> New Vendor</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="treeview-menu">
                        <li @if(Request::is('admin/product_types*')) class="active" @endif>
                            <a href="#"><i class="fa fa-circle-o"></i> Product Types <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                <li @if(Request::is('admin/product_types')) class="active" @endif><a href="{{ url('admin/product_types') }}"><i class="fa fa-list"></i> Types List</a></li>
                                <li @if(Request::is('admin/product_types/create')) class="active" @endif><a href="{{ url('admin/product_types/create') }}"><i class="fa fa-pencil"></i> New Type</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @endif

            @if($helper->check(Config::get('constants.MENU_COLLECTIONS'),Config::get('constants.BACKEND_ADMIN')))            
                <li class="treeview @if(Request::is('admin/collections*')) active @endif">
                    <a href="#">
                        <i class="fa fa-edit"></i> <span>Collections List</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li @if(Request::is('admin/collections')) class="active" @endif><a href="{{ url('admin/collections') }}"><i class="fa fa-list"></i> Collections List</a></li>
                        <li @if(Request::is('admin/collections/create')) class="active" @endif><a href="{{ url('admin/collections/create') }}"><i class="fa fa-pencil"></i> New Collection</a></li>
                    </ul>
                </li>
            @endif

            @if($helper->check(Config::get('constants.MENU_DISCOUNTS'),Config::get('constants.BACKEND_ADMIN')))
                <li class="treeview @if(Request::is('admin/discount*')) active @endif">
                    <a href="#">
                        <i class="fa fa-edit"></i> <span>Discounts</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li @if(Request::is('admin/discount')) class="active" @endif><a href="{{ url('admin/discount') }}"><i class="fa fa-list"></i> Discounts</a></li>
                        <li @if(Request::is('admin/discount/create')) class="active" @endif><a href="{{ url('admin/discount/create') }}"><i class="fa fa-pencil"></i> New Discount</a></li>
                    </ul>
                </li>
            @endif

            @if($helper->check(Config::get('constants.MENU_PLANS'),Config::get('constants.BACKEND_ADMIN')))
                <li class="treeview @if(Request::is('admin/plans*')) active @endif">
                    <a href="#">
                        <i class="fa fa-edit"></i> <span>Plans</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li @if(Request::is('admin/plans')) class="active" @endif><a href="{{ url('admin/plans') }}"><i class="fa fa-list"></i> Plans</a></li>
                        <li @if(Request::is('admin/plans/create')) class="active" @endif><a href="{{ url('admin/plans/create') }}"><i class="fa fa-pencil"></i> New Plan</a></li>
                    </ul>
                </li>
            @endif

            @if($helper->check(Config::get('constants.MENU_NAVIGATION'),Config::get('constants.BACKEND_ADMIN')))
                <li class="treeview @if(Request::is('admin/navigation*')) active @endif">
                    <a href="#">
                        <i class="fa fa-edit"></i> <span>Navigation</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li @if(Request::is('admin/menu-items')) class="active" @endif><a href="{{ url('admin/menu-items') }}"><i class="fa fa-list"></i> Navigation List</a></li>
                        <li @if(Request::is('admin/menu-item/create')) class="active" @endif><a href="{{ url('admin/menu-item/create') }}"><i class="fa fa-pencil"></i> New Navigation</a></li>
                    </ul>
                </li>
            @endif
            
            @if($helper->check(Config::get('constants.MENU_TESTEMONIALS'),Config::get('constants.BACKEND_ADMIN')))            
                <li class="treeview @if(Request::is('admin/testemonials*')) active @endif">
                    <a href="#">
                        <i class="fa fa-users"></i> <span>Testemonials</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li @if(Request::is('admin/testemonials')) class="active" @endif><a href="{{ url('admin/testemonials') }}"><i class="fa fa-list"></i>Testemonials List</a></li>
                        <li @if(Request::is('admin/testemonials/create')) class="active" @endif><a href="{{ url('admin/testemonials/create') }}"><i class="fa fa-pencil"></i> New Testemonial</a></li>
                    </ul>
                </li>
            @endif
            
  
            
            @if($helper->check(Config::get('constants.MENU_SETTINGS'),Config::get('constants.BACKEND_ADMIN')))
                <li class="treeview @if(Request::is('admin/accounts*') || Request::is('admin/account*') || Request::is('admin/settings*')) active @endif">
                    <a href="#">
                        <i class="fa fa-cog"></i> <span>Settings</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li @if(Request::is('admin/accounts')) class="active" @endif><a href="{{ url('admin/accounts') }}"><i class="fa fa-list"></i>Accounts List</a></li>
                        <li @if(Request::is('admin/account/create')) class="active" @endif><a href="{{ url('admin/accounts/create') }}"><i class="fa fa-pencil"></i>New Account</a></li>
                        <li @if(Request::is('admin/settings/general')) class="active" @endif><a href="{{ url('admin/settings/general') }}"><i class="fa fa-cog"></i>General Settings</a></li>
          
                    </ul>
                </li>
            @endif
            
            @if($helper->check(Config::get('constants.MENU_EMAILS'),Config::get('constants.BACKEND_ADMIN')))            
                <li class="treeview @if(Request::is('admin/emails*')) active @endif">
                    <a href="#">
                        <i class="fa fa-envelope-o"></i> <span>Emails</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li @if(Request::is('admin/emails')) class="active" @endif><a href="{{ url('admin/emails') }}"><i class="fa fa-list"></i> Emails List</a></li>
                        <li @if(Request::is('admin/emails/create')) class="active" @endif><a href="{{ url('admin/emails/create') }}"><i class="fa fa-pencil"></i> New Email</a></li>
                    </ul>
                </li>            
            @endif
            
                      
            @if($helper->check(Config::get('constants.MENU_REPORTS'),Config::get('constants.BACKEND_ADMIN')))            
                <li class="treeview @if(Request::is('admin/reports*')) active @endif">
                    <a href="#">
                        <i class="fa fa-list"></i> <span>Reports</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li @if(Request::is('admin/reports')) class="active" @endif><a href="{{ url('admin/reports') }}"><i class="fa fa-list"></i>Reports List</a></li>
                       
                    </ul>
                </li>            
            @endif

            @if($helper->check(Config::get('constants.MENU_ORDERS'),Config::get('constants.FULFILLMENT_ADMIN')))
                <li class="treeview @if(Request::is('admin/orders*')) active @endif">
                    <a href="#">
                        <i class="fa fa-book"></i> <span>Orders</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li @if(Request::is('admin/orders')) class="active" @endif><a href="{{ url('admin/orders') }}"><i class="fa fa-list"></i> Orders List</a></li>
                    </ul>
                </li>
            @endif
            
            @if($helper->check(Config::get('constants.MENU_CUSTOMERS'),Config::get('constants.CUSTOMER_ADMIN')))            
                <li class="treeview @if(Request::is('admin/customers*')) active @endif">
                    <a href="#">
                        <i class="fa fa-users"></i> <span>Customers</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li @if(Request::is('admin/customers')) class="active" @endif><a href="{{ url('admin/customers') }}"><i class="fa fa-list"></i> Customers List</a></li>
                        <li @if(Request::is('admin/customers/create')) class="active" @endif><a href="{{ url('admin/customers/create') }}"><i class="fa fa-pencil"></i> New Customer</a></li>
                    </ul>
                </li>
            @endif

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>