<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
| 
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    
	// Route::auth() - replacement for all the login/logout/register routes. Automatically generated
    Route::auth();

    
    // Site Controller
    Route::get('/', 			['uses'=>'Site\HomeController@index']);
    Route::get('about', 		['uses'=>'Site\AboutController@index']);
    Route::get('contact', 		['uses'=>'Site\ContactController@index']);
    Route::get('faq', 			['uses'=>'Site\FaqController@index']);
    Route::get('public_login', 	['uses'=>'Site\LoginController@index']);
    Route::get('login_home', 	['uses'=>'Site\LoginController@getLogin']);
    Route::get('public_register', 	['uses'=>'Site\RegisterController@index']);
    Route::get('coffees', 		['uses'=>'Site\ProductController@index']);
    Route::get('order_plan', 	['uses'=>'Site\ProductController@getStepPlans']);
    Route::get('order_packages',['uses'=>'Site\ProductController@getStepPackages']);
    Route::get('order_billing', ['uses'=>'Site\ProductController@getStepBilling']);

    Route::post('step3', 		['uses'=>'Site\ProductController@postStep3']);
	

    // Contact
	Route::post('contact_us',   ['uses'=>'Site\ContactController@contactUs']);


    //Customer Profile
    Route::get('profile', 		['uses'=>'Site\ProfileController@index']);
    Route::post('profile/{id}',         ['uses'=>'Site\ProfileController@postUpdate']);


    //Testemonials
    Route::get('testemonials', 		['uses'=>'Site\TestemonialController@index']);
    Route::post('testemonials/{id}',         ['uses'=>'Site\TestemonialController@postUpdate']);
    Route::get('testemonials_list',         ['uses'=>'Site\TestemonialController@getTestemonialsPage']);


    //Shipping
    Route::get('shipping', 		['uses'=>'Site\ShippingController@index']);
    Route::post('shipping/{id}', 		['uses'=>'Site\ShippingController@postUpdate']);


    //Billing
    Route::get('billing', 		['uses'=>'Site\BillingController@index']);
    Route::post('billing/{id}', 		['uses'=>'Site\BillingController@postUpdate']);


    // User orders route
    Route::get('orders', 		['uses'=>'Site\ProfileController@getUserOrders']);


    // Static Pages
    Route::get('how-it-works', 		['uses'=>'Site\PagesController@how_it_works']);
    Route::get('terms', 		['uses'=>'Site\PagesController@terms']);
    Route::get('privacy', 		['uses'=>'Site\PagesController@privacy']);


    // Used for ajax request in shopping cart
    Route::post('update_cart', 		['uses'=>'Site\ShoppingCartController@postUpdateCart']);
    Route::post('add_item_to_cart', ['uses'=>'Site\ShoppingCartController@postAddItemToCart']);
    Route::post('remove_item_from_cart', ['uses'=>'Site\ShoppingCartController@postRemoveItemFromCart']);


    // Stripe
    Route::get('stripeTest', 'Site\StripeController@index');
    Route::post('stripeTest', 'Site\StripeController@postStripe');
    Route::get('stripe/success', 'Site\StripeController@getSuccess');
    Route::get('stripe/cancel-subscription', 'Site\StripeController@cancelSubscription');
    Route::get('stripe/stripe_review', 'Site\StripeController@stripedashboard');


    // Blog
    Route::get('blog', 			['uses'=>'Site\BlogController@index']);
    Route::get('blog/{slug}', 	['uses'=>'Site\BlogController@showPost']);


    // Products
    Route::get('product/{slug}', 	['uses'=>'Site\ProductController@showProduct']);


    // Gifts 
    Route::get('gift_plan', 	['uses'=>'Site\GiftController@getStepPlans']);
    Route::get('gift_packages',['uses'=>'Site\GiftController@getStepPackages']);
    Route::get('gift_billing', ['uses'=>'Site\GiftController@getStepBilling']);
    Route::post('gift_step3', 		['uses'=>'Site\GiftController@postStep3']);


    // Admin login route
	Route::get('admin/login', 'Admin\LoginController@getShowLoginForm');
});

/*
|--------------------------------------------------------------------------
| Admin Protected Routes
|--------------------------------------------------------------------------
|
| This route group applies the "admin" middleware group to every route
| it contains. In Kernel.php file new admin middleware is defined. This
| is a middleware which contains group of other middlewares.
|
*/

Route::group(['middleware' => ['admin','checkAdminAccess']], function () {
    
	Route::get('admin/dashboard', ['uses'=>'Admin\DashboardController@index','admin_right'=>Config::get('constants.MENU_DASHBOARD'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
        Route::get('admin/dashboard_yesterday', ['uses' => 'Admin\DashboardController@indexYesterday', 'admin_right' => Config::get('constants.MENU_DASHBOARD'), 'role' => Config::get('constants.BACKEND_ADMIN'), 'middleware' => 'checkAdminRights']);
        Route::get('admin/dashboard_7Days', ['uses' => 'Admin\DashboardController@index7Days', 'admin_right' => Config::get('constants.MENU_DASHBOARD'), 'role' => Config::get('constants.BACKEND_ADMIN'), 'middleware' => 'checkAdminRights']);
        Route::get('admin/dashboard_30Days', ['uses' => 'Admin\DashboardController@index30Days', 'admin_right' => Config::get('constants.MENU_DASHBOARD'), 'role' => Config::get('constants.BACKEND_ADMIN'), 'middleware' => 'checkAdminRights']);
        Route::get('admin/dashboard_all_time', ['uses' => 'Admin\DashboardController@indexAllTime', 'admin_right' => Config::get('constants.MENU_DASHBOARD'), 'role' => Config::get('constants.BACKEND_ADMIN'), 'middleware' => 'checkAdminRights']);

    // Admin FAQ Cateogories 
	Route::get(	'admin/faq_categories', 			['uses'=>'Admin\FaqCategoryController@index','admin_right'=>Config::get('constants.MENU_FAQ_CATEGORIES'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get(	'admin/faq_categories/create', 		 ['uses'=>'Admin\FaqCategoryController@getCreate','admin_right'=>Config::get('constants.MENU_FAQ_CATEGORIES'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/faq_categories/create', 		 ['uses' => 'Admin\FaqCategoryController@postCreate','admin_right'=>Config::get('constants.MENU_FAQ_CATEGORIES'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get(	'admin/faq_categories/{id}/edit', 	 ['uses'=>'Admin\FaqCategoryController@getEdit','admin_right'=>Config::get('constants.MENU_FAQ_CATEGORIES'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/faq_categories/{id}/edit', 	 ['uses' =>'Admin\FaqCategoryController@postEdit','admin_right'=>Config::get('constants.MENU_FAQ_CATEGORIES'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/faq_categories/update', 		 ['uses' =>'Admin\FaqCategoryController@postUpdate','admin_right'=>Config::get('constants.MENU_FAQ_CATEGORIES'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/faq_categories/delete', 		 ['uses' => 'Admin\FaqCategoryController@postDelete','admin_right'=>Config::get('constants.MENU_FAQ_CATEGORIES'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);


	// Admin FAQs 
	Route::get(	'admin/faqs', 				['uses'=>'Admin\FaqController@index','admin_right'=>Config::get('constants.MENU_FAQ'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get(	'admin/faqs/create', 		['uses'=>'Admin\FaqController@getCreate','admin_right'=>Config::get('constants.MENU_FAQ'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/faqs/create', 		['uses'=>'Admin\FaqController@postCreate','role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get(	'admin/faqs/{id}/edit', 	['uses'=>'Admin\FaqController@getEdit','admin_right'=>Config::get('constants.MENU_FAQ'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get('admin/faqs/export/{id}',    ['uses'=>'Admin\FaqController@export','admin_right'=>Config::get('constants.MENU_FAQ'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/faqs/{id}/edit', 	['uses'=>'Admin\FaqController@postEdit','role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/faqs/update', 		['uses'=>'Admin\FaqController@postUpdate','role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/faqs/delete', 		['uses'=>'Admin\FaqController@postDelete','role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
        
        // Admin Testemonials 
	Route::get(	'admin/testemonials', 				['uses'=>'Admin\TestemonialController@index','admin_right'=>Config::get('constants.MENU_TESTEMONIALS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get(	'admin/testemonials/create', 		['uses'=>'Admin\TestemonialController@getCreate','admin_right'=>Config::get('constants.MENU_TESTEMONIALS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/testemonials/create', 		['uses'=>'Admin\TestemonialController@postCreate','admin_right'=>Config::get('constants.MENU_TESTEMONIALS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get(	'admin/testemonials/{id}/edit', 	['uses'=>'Admin\TestemonialController@getEdit','admin_right'=>Config::get('constants.MENU_TESTEMONIALS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get('admin/testemonials/export/{id}',    ['uses'=>'Admin\TestemonialController@export','admin_right'=>Config::get('constants.MENU_TESTEMONIALS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/testemonials/{id}/edit', 	['uses'=>'Admin\TestemonialController@postEdit','admin_right'=>Config::get('constants.MENU_TESTEMONIALS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/testemonials/update', 		['uses'=>'Admin\TestemonialController@postUpdate','admin_right'=>Config::get('constants.MENU_TESTEMONIALS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/testemonials/delete', 		['uses'=>'Admin\TestemonialController@postDelete','admin_right'=>Config::get('constants.MENU_TESTEMONIALS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
        Route::post('admin/testemonials/save_order', 		['uses'=>'Admin\TestemonialController@postSaveOrder','admin_right'=>Config::get('constants.MENU_TESTEMONIALS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
        Route::get('admin/testemonials/export_testemonials/{id}',   ['uses'=>'Admin\TestemonialController@export','admin_right'=>Config::get('constants.MENU_TESTEMONIALS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
        
         // Admin Reports
	Route::get(	'admin/reports', 				['uses'=>'Admin\ReportController@index','admin_right'=>Config::get('constants.MENU_REPORTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get(	'admin/reports/orders_months', 		['uses'=>'Admin\ReportController@getOrdersMonths','admin_right'=>Config::get('constants.MENU_REPORTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get(	'admin/reports/orders_hours', 		['uses'=>'Admin\ReportController@getOrdersHours','admin_right'=>Config::get('constants.MENU_REPORTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
        Route::get(	'admin/reports/orders_customers', 		['uses'=>'Admin\ReportController@getOrdersCustomers','admin_right'=>Config::get('constants.MENU_REPORTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
        Route::get(	'admin/reports/orders_billings', 		['uses'=>'Admin\ReportController@getOrdersbillingAddresses','admin_right'=>Config::get('constants.MENU_REPORTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
        Route::get(	'admin/reports/orders_billing_cities', 		['uses'=>'Admin\ReportController@getOrdersBillingCities','admin_right'=>Config::get('constants.MENU_REPORTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
        Route::get(	'admin/reports/orders_billing_states', 		['uses'=>'Admin\ReportController@getOrdersBillingStates','admin_right'=>Config::get('constants.MENU_REPORTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
        Route::get('admin/reports/export_orders_months/{id}',   ['uses'=>'Admin\ReportController@exportOrdersMonths','admin_right'=>Config::get('constants.MENU_REPORTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
        Route::get('admin/reports/export_orders_hours/{id}',   ['uses'=>'Admin\ReportController@exportOrdersHours','admin_right'=>Config::get('constants.MENU_REPORTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
        Route::get('admin/reports/export_orders_customers/{id}',   ['uses'=>'Admin\ReportController@exportOrdersCustomers','admin_right'=>Config::get('constants.MENU_REPORTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
        Route::get('admin/reports/export_orders_billing_addresses/{id}',   ['uses'=>'Admin\ReportController@exportOrdersBillingAddresses','admin_right'=>Config::get('constants.MENU_REPORTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
        Route::get('admin/reports/export_orders_billing_cities/{id}',   ['uses'=>'Admin\ReportController@exportOrdersBillingCities','admin_right'=>Config::get('constants.MENU_REPORTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
        Route::get('admin/reports/export_orders_billing_states/{id}',   ['uses'=>'Admin\ReportController@exportOrdersBillingStates','admin_right'=>Config::get('constants.MENU_REPORTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
      
        Route::get('admin/reports/export_payment_customers/{id}',   ['uses'=>'Admin\ReportController@exportPaymentCustomers','admin_right'=>Config::get('constants.MENU_REPORTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
        Route::get('admin/reports/orders_payment_customers',   ['uses'=>'Admin\ReportController@getPaymentCustomers','admin_right'=>Config::get('constants.MENU_REPORTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
        
        Route::get('admin/reports/export_subscriptions_plans/{id}',   ['uses'=>'Admin\ReportController@exportSubscriptionsByPlans','admin_right'=>Config::get('constants.MENU_REPORTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
        Route::get('admin/reports/subscriptions_plans',   ['uses'=>'Admin\ReportController@getSubscriptionsByPlans','admin_right'=>Config::get('constants.MENU_REPORTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
        
       

	// Admin posts 
	Route::get(	'admin/pages', 				 ['uses'=>'Admin\PostController@indexPages','admin_right'=>Config::get('constants.MENU_PAGES'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get(	'admin/pages/create', 		 ['uses'=>'Admin\PostController@getPageCreate','admin_right'=>Config::get('constants.MENU_PAGES'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/pages/create', 		['uses'=>'Admin\PostController@postPageCreate','admin_right'=>Config::get('constants.MENU_PAGES'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get(	'admin/pages/{id}/edit', 	 ['uses'=>'Admin\PostController@getPageEdit','admin_right'=>Config::get('constants.MENU_PAGES'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/pages/{id}/edit', 	['uses'=>'Admin\PostController@postPageEdit','admin_right'=>Config::get('constants.MENU_PAGES'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get('admin/pages/export_pages/{id}',   ['uses'=>'Admin\PostController@export_pages','admin_right'=>Config::get('constants.MENU_PAGES'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);

	Route::get('admin/posts/export/{id}',     ['uses'=>'Admin\PostController@export','admin_right'=>Config::get('constants.MENU_POSTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/posts/update', 		  ['uses'=>'Admin\PostController@postUpdate','admin_right'=>Config::get('constants.MENU_POSTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/posts/delete', 		  ['uses'=>'Admin\PostController@postDelete','admin_right'=>Config::get('constants.MENU_POSTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);


	Route::get(	'admin/posts', 				 ['uses'=>'Admin\PostController@indexPosts','admin_right'=>Config::get('constants.MENU_POSTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get(	'admin/posts/create', 		 ['uses'=>'Admin\PostController@getPostCreate','admin_right'=>Config::get('constants.MENU_POSTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/posts/create', 		  ['uses'=>'Admin\PostController@postPostCreate','admin_right'=>Config::get('constants.MENU_POSTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get(	'admin/posts/{id}/edit', 	 ['uses'=>'Admin\PostController@getPostEdit','admin_right'=>Config::get('constants.MENU_POSTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/posts/{id}/edit', 	['uses'=>'Admin\PostController@postPostEdit','admin_right'=>Config::get('constants.MENU_POSTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post(	'admin/posts/preview', 	 ['uses'=>'Admin\PostController@postPreview','admin_right'=>Config::get('constants.MENU_POSTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);



	// Admin Post Categories 
	Route::get(	'admin/post_category', 				 ['uses'=>'Admin\PostCategoryController@index','admin_right'=>Config::get('constants.MENU_POSTS_CATEGORIES'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get(	'admin/post_category/create', 		 ['uses'=>'Admin\PostCategoryController@getCreate','admin_right'=>Config::get('constants.MENU_POSTS_CATEGORIES'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/post_category/create', 		['uses'=>'Admin\PostCategoryController@postCreate','admin_right'=>Config::get('constants.MENU_POSTS_CATEGORIES'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get(	'admin/post_category/{id}/edit', 	 ['uses'=>'Admin\PostCategoryController@getEdit','admin_right'=>Config::get('constants.MENU_POSTS_CATEGORIES'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/post_category/{id}/edit', 	['uses'=>'Admin\PostCategoryController@postEdit','admin_right'=>Config::get('constants.MENU_POSTS_CATEGORIES'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/post_category/update', 		['uses'=>'Admin\PostCategoryController@postUpdate','admin_right'=>Config::get('constants.MENU_POSTS_CATEGORIES'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/post_category/delete', 		['uses'=>'Admin\PostCategoryController@postDelete','admin_right'=>Config::get('constants.MENU_POSTS_CATEGORIES'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);




	// Admin Product Vendors 
	Route::get(	'admin/product_vendors', 				['uses'=>'Admin\ProductVendorController@index','admin_right'=>Config::get('constants.MENU_PRODUCTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get(	'admin/product_vendors/create', 		['uses'=>'Admin\ProductVendorController@getCreate','admin_right'=>Config::get('constants.MENU_PRODUCTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/product_vendors/create', 		['uses'=>'Admin\ProductVendorController@postCreate','admin_right'=>Config::get('constants.MENU_PRODUCTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get(	'admin/product_vendors/{id}/edit', 		['uses'=>'Admin\ProductVendorController@getEdit','admin_right'=>Config::get('constants.MENU_PRODUCTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/product_vendors/{id}/edit', 		['uses'=>'Admin\ProductVendorController@postEdit','admin_right'=>Config::get('constants.MENU_PRODUCTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/product_vendors/update', 		['uses'=>'Admin\ProductVendorController@postUpdate','admin_right'=>Config::get('constants.MENU_PRODUCTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/product_vendors/delete', 		['uses'=>'Admin\ProductVendorController@postDelete','admin_right'=>Config::get('constants.MENU_PRODUCTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);

	// Admin Product Types 
	Route::get(	'admin/product_types', 					['uses'=>'Admin\ProductTypeController@index','admin_right'=>Config::get('constants.MENU_PRODUCTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get(	'admin/product_types/create', 			['uses'=>'Admin\ProductTypeController@getCreate','admin_right'=>Config::get('constants.MENU_PRODUCTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/product_types/create', 			['uses'=>'Admin\ProductTypeController@postCreate','admin_right'=>Config::get('constants.MENU_PRODUCTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get(	'admin/product_types/{id}/edit', 		['uses'=>'Admin\ProductTypeController@getEdit','admin_right'=>Config::get('constants.MENU_PRODUCTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/product_types/{id}/edit', 		['uses'=>'Admin\ProductTypeController@postEdit','admin_right'=>Config::get('constants.MENU_PRODUCTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/product_types/update', 			['uses'=>'Admin\ProductTypeController@postUpdate','admin_right'=>Config::get('constants.MENU_PRODUCTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/product_types/delete', 			['uses'=>'Admin\ProductTypeController@postDelete','admin_right'=>Config::get('constants.MENU_PRODUCTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
       

    //Admin Settings
    Route::get(	'admin/accounts', 					['uses'=>'Admin\SettingController@index','admin_right'=>Config::get('constants.MENU_SETTINGS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
    Route::get(	'admin/accounts/create', 					['uses'=>'Admin\SettingController@getCreate','admin_right'=>Config::get('constants.MENU_SETTINGS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
    Route::post(	'admin/accounts/delete', 					['uses'=>'Admin\SettingController@postDelete','admin_right'=>Config::get('constants.MENU_SETTINGS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
    Route::post(	'admin/accounts/create', 					['uses'=>'Admin\SettingController@postCreate','admin_right'=>Config::get('constants.MENU_SETTINGS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
    Route::get(	'admin/accounts/edit/{id}', 					['uses'=>'Admin\SettingController@getEdit','admin_right'=>Config::get('constants.MENU_SETTINGS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
    Route::post(	'admin/accounts/update/{id}', 					['uses'=>'Admin\SettingController@postUpdate','admin_right'=>Config::get('constants.MENU_SETTINGS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);

    Route::get(	'admin/settings/general', 					['uses'=>'Admin\SettingController@indexGeneral','admin_right'=>Config::get('constants.MENU_SETTINGS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
    Route::post(	'admin/settings/update/', 					['uses'=>'Admin\SettingController@postUpdateGeneral','admin_right'=>Config::get('constants.MENU_SETTINGS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
    


    // Admin Customers         
    Route::get(	'admin/customers', 					['uses'=>'Admin\CustomerController@index','admin_right'=>Config::get('constants.MENU_CUSTOMERS'),'role'=>Config::get('constants.CUSTOMER_ADMIN'),'middleware'=>'checkAdminRights']);
    Route::get(	'admin/customers/create', 					['uses'=>'Admin\CustomerController@getCreate','admin_right'=>Config::get('constants.MENU_CUSTOMERS'),'role'=>Config::get('constants.CUSTOMER_ADMIN'),'middleware'=>'checkAdminRights']);
    Route::post(	'admin/customers/delete', 					['uses'=>'Admin\CustomerController@postDelete','admin_right'=>Config::get('constants.MENU_CUSTOMERS'),'role'=>Config::get('constants.CUSTOMER_ADMIN'),'middleware'=>'checkAdminRights']);
    Route::post(	'admin/customers/create', 					['uses'=>'Admin\CustomerController@postCreate','admin_right'=>Config::get('constants.MENU_CUSTOMERS'),'role'=>Config::get('constants.CUSTOMER_ADMIN'),'middleware'=>'checkAdminRights']);
    Route::get(	'admin/customers/edit/{id}', 					['uses'=>'Admin\CustomerController@getEdit','admin_right'=>Config::get('constants.MENU_CUSTOMERS'),'role'=>Config::get('constants.CUSTOMER_ADMIN'),'middleware'=>'checkAdminRights']);
    Route::post(	'admin/customers/update/{id}', 					['uses'=>'Admin\CustomerController@postUpdate','admin_right'=>Config::get('constants.MENU_CUSTOMERS'),'role'=>Config::get('constants.CUSTOMER_ADMIN'),'middleware'=>'checkAdminRights']);
    Route::get('admin/account/export/{id}',        ['uses'=>'Admin\SettingController@export','admin_right'=>Config::get('constants.MENU_CUSTOMERS'),'role'=>Config::get('constants.CUSTOMER_ADMIN'),'middleware'=>'checkAdminRights']);
    Route::get('admin/customers/export/{id}',    ['uses'=>'Admin\CustomerController@export','admin_right'=>Config::get('constants.MENU_CUSTOMERS'),'role'=>Config::get('constants.CUSTOMER_ADMIN'),'middleware'=>'checkAdminRights']);


    

	// Admin Navigation routes
	Route::get('admin/navigation', ['as' => 'navigation-home', 'uses' => 'Admin\NavigationController@index']);
	Route::get('admin/navigation/create', ['uses'=>'Admin\NavigationController@getCreate','admin_right'=>Config::get('constants.MENU_NAVGATION'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/navigation/create', ['uses'=>'Admin\NavigationController@postCreate','admin_right'=>Config::get('constants.MENU_NAVGATION'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get('admin/navigation/{id}/delete', ['uses'=>'Admin\NavigationController@delete','admin_right'=>Config::get('constants.MENU_NAVGATION'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get('admin/navigation/{id}/edit', ['uses'=>'Admin\NavigationController@show','admin_right'=>Config::get('constants.MENU_NAVGATION'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/navigation/{id}/update', ['uses'=>'Admin\NavigationController@store','admin_right'=>Config::get('constants.MENU_NAVGATION'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/navigation/{id}/delete', ['uses'=>'Admin\NavigationController@delete','admin_right'=>Config::get('constants.MENU_NAVGATION'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/product/sort', ['uses'=>'Admin\NavigationController@sort','admin_right'=>Config::get('constants.MENU_NAVGATION'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);

	// Admin Discount routes
	Route::get('admin/discount', ['as' => 'discount-home', 'uses' => 'Admin\DiscountController@index','admin_right'=>Config::get('constants.MENU_DISCOUNTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get('admin/discount/create', ['uses'=>'Admin\DiscountController@create','admin_right'=>Config::get('constants.MENU_DISCOUNTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/discount/create', ['uses'=>'Admin\DiscountController@store','admin_right'=>Config::get('constants.MENU_DISCOUNTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/discount/getCode', ['uses'=>'Admin\DiscountController@getCode','admin_right'=>Config::get('constants.MENU_DISCOUNTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get('admin/discount/{id}/delete', ['uses'=>'Admin\DiscountController@destroy','admin_right'=>Config::get('constants.MENU_DISCOUNTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get('admin/discount/switch-status', ['uses'=>'Admin\DiscountController@switchStatus','admin_right'=>Config::get('constants.MENU_DISCOUNTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get('admin/discount/{id}/edit', ['uses'=>'Admin\DiscountController@edit','admin_right'=>Config::get('constants.MENU_DISCOUNTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/discount/{id}/update', ['uses'=>'Admin\DiscountController@update','admin_right'=>Config::get('constants.MENU_DISCOUNTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get('admin/discount/export/{id}',        ['uses'=>'Admin\DiscountController@export','admin_right'=>Config::get('constants.MENU_DISCOUNTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/discount/switch-status/{id}', ['uses'=>'Admin\DiscountController@postUpdate','admin_right'=>Config::get('constants.MENU_DISCOUNTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);

	// Admin MenuItems routes
	Route::get('admin/menu-items', ['as' => 'admin-menu-items', 'uses' => 'Admin\MenuItemsController@index']);
	Route::get('admin/menu-item/create', 'Admin\MenuItemsController@getCreate');
	Route::post('admin/menu-item/create', 'Admin\MenuItemsController@postCreate');
	Route::get('admin/menu-item/{id}/edit', 'Admin\MenuItemsController@getEdit');
	Route::post('admin/menu-item/{id}/edit', 'Admin\MenuItemsController@postEdit');
	Route::post('admin/menu-item/{id}/delete', 'Admin\MenuItemsController@delete');
	Route::post('admin/menu-item/switch-status/{id}', 'Admin\MenuItemsController@switchStatus');
	Route::post('admin/menu-items/sort', 'Admin\MenuItemsController@sort');

            // Admin Products 
	Route::get(	'admin/products', 					['uses'=>'Admin\ProductController@index','admin_right'=>Config::get('constants.MENU_PRODUCTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get(	'admin/products/create', 			['uses'=>'Admin\ProductController@getCreate','admin_right'=>Config::get('constants.MENU_PRODUCTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/products/create', 			['uses'=>'Admin\ProductController@postCreate','admin_right'=>Config::get('constants.MENU_PRODUCTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get(	'admin/products/{id}/edit', 		['uses'=>'Admin\ProductController@getEdit','admin_right'=>Config::get('constants.MENU_PRODUCTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get('admin/products/export/{id}',        ['uses'=>'Admin\ProductController@export','admin_right'=>Config::get('constants.MENU_PRODUCTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/products/{id}/edit', 		['uses'=>'Admin\ProductController@postEdit','admin_right'=>Config::get('constants.MENU_PRODUCTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/products/update', 			['uses'=>'Admin\ProductController@postUpdate','admin_right'=>Config::get('constants.MENU_PRODUCTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/products/delete', 			['uses'=>'Admin\ProductController@postDelete','admin_right'=>Config::get('constants.MENU_PRODUCTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/products/delete_image', 		['uses'=>'Admin\ProductController@postDeleteImage','admin_right'=>Config::get('constants.MENU_PRODUCTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/products/preview', 			['uses'=>'Admin\ProductController@postPreview','admin_right'=>Config::get('constants.MENU_PRODUCTS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
        

	// Admin Plans
	Route::get('admin/plans', 						['as' => 'admin-plans', 'uses' => 'Admin\PlanController@index']);
	Route::get('admin/plans/create',				['uses'=>'Admin\PlanController@getCreate','admin_right'=>Config::get('constants.MENU_PLANS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/plans/create',				['uses'=>'Admin\PlanController@postCreate','admin_right'=>Config::get('constants.MENU_PLANS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get('admin/plans/{id}/edit', 			['uses'=>'Admin\PlanController@getEdit','admin_right'=>Config::get('constants.MENU_PLANS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/plan/{id}/edit', 			['uses'=>'Admin\PlanController@postEdit','admin_right'=>Config::get('constants.MENU_PLANS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get('admin/plan/{id}/delete', 			['uses'=>'Admin\PlanController@delete','admin_right'=>Config::get('constants.MENU_PLANS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get('admin/plan/{id}/delete', 			['uses'=>'Admin\PlanController@delete','admin_right'=>Config::get('constants.MENU_PLANS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/plans/update',	 			['uses'=>'Admin\PlanController@postUpdate','admin_right'=>Config::get('constants.MENU_PLANS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);


	// Dropzene ajax uploader
	Route::get('dropzone', 				'Admin\DropzoneController@index');
	Route::post('dropzone/uploadFiles', 'Admin\DropzoneController@uploadFiles');


	// Admin Collections 
	Route::get(	'admin/collections', 					['uses'=>'Admin\CollectionController@index','admin_right'=>Config::get('constants.MENU_COLLECTIONS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get(	'admin/collections/create', 			['uses'=>'Admin\CollectionController@getCreate','admin_right'=>Config::get('constants.MENU_COLLECTIONS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/collections/create', 			['uses'=>'Admin\CollectionController@postCreate','admin_right'=>Config::get('constants.MENU_COLLECTIONS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get(	'admin/collections/{id}/edit', 			['uses'=>'Admin\CollectionController@getEdit','admin_right'=>Config::get('constants.MENU_COLLECTIONS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get('admin/collections/export/{id}',        ['uses'=>'Admin\CollectionController@export','admin_right'=>Config::get('constants.MENU_COLLECTIONS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/collections/{id}/edit', 			['uses'=>'Admin\CollectionController@postEdit','admin_right'=>Config::get('constants.MENU_COLLECTIONS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/collections/update', 			['uses'=>'Admin\CollectionController@postUpdate','admin_right'=>Config::get('constants.MENU_COLLECTIONS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/collections/delete', 			['uses'=>'Admin\CollectionController@postDelete','admin_right'=>Config::get('constants.MENU_COLLECTIONS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
        


    // Admin Emails     
    Route::get(	'admin/emails', 					['uses'=>'Admin\EmailController@index','admin_right'=>Config::get('constants.MENU_EMAILS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
    Route::get(	'admin/emails/create', 					['uses'=>'Admin\EmailController@getCreate','admin_right'=>Config::get('constants.MENU_EMAILS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
    Route::post(	'admin/emails/create', 					['uses'=>'Admin\EmailController@postCreate','admin_right'=>Config::get('constants.MENU_EMAILS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
    Route::get(	'admin/emails/edit/{id}', 					['uses'=>'Admin\EmailController@getEdit','admin_right'=>Config::get('constants.MENU_EMAILS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);         
    Route::post('admin/emails/update/{id}', 			['uses'=>'Admin\EmailController@postUpdate','admin_right'=>Config::get('constants.MENU_EMAILS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
    Route::post('admin/emails/delete', 			['uses'=>'Admin\EmailController@postDelete','admin_right'=>Config::get('constants.MENU_EMAILS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
    Route::post('admin/emails/sendTestEmail/{id}', 			['uses'=>'Admin\EmailController@sendTestEmail','admin_right'=>Config::get('constants.MENU_EMAILS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
    Route::get('admin/emails/export/{id}',        ['uses'=>'Admin\Emails@export','admin_right'=>Config::get('constants.MENU_EMAILS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
    Route::post('admin/email/processEmailSrc/{id}',             ['uses'=>'Admin\Emails@processEmailSrc','admin_right'=>Config::get('constants.MENU_EMAILS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);
    Route::post('admin/email/processTemplate',          ['uses'=>'Admin\Emails@processTemplate','admin_right'=>Config::get('constants.MENU_EMAILS'),'role'=>Config::get('constants.BACKEND_ADMIN'),'middleware'=>'checkAdminRights']);

	// Admin Orders
	Route::get(	'admin/orders', 					['uses'=>'Admin\OrderController@index','admin_right'=>Config::get('constants.MENU_ORDERS'),'role'=>Config::get('constants.FULFILLMENT_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::get('admin/orders/update/{id}/{deliver}', 			['uses'=>'Admin\OrderController@postUpdate','admin_right'=>Config::get('constants.MENU_ORDERS'),'role'=>Config::get('constants.FULFILLMENT_ADMIN'),'middleware'=>'checkAdminRights']);
	Route::post('admin/orders/delete', 			['uses'=>'Admin\OrderController@postDelete','admin_right'=>Config::get('constants.MENU_ORDERS'),'role'=>Config::get('constants.FULFILLMENT_ADMIN'),'middleware'=>'checkAdminRights']);

	Route::get('admin/stripeTest', 'Admin\StripeController@index');
	Route::post('admin/stripeTest', 'Admin\StripeController@postStripe');


	Route::get('admin/seed_users', 'Admin\FakerController@seed_users');
	Route::post('admin/seed_products', 'Admin\FakerController@seed_products');


});