<?php
Route::middleware(['init'])->group(function () {
Auth::routes();
Route::middleware(['checkLogin'])->group(function () {
    Route::get('login', 'AdminAuthController@login');
});
Route::middleware(['adminAuth'])->group(function () {
    Route::get('/dashboard', 'AdminDashboardController@dashboard');
    Route::resource('category','CategoryController');
    Route::resource('subcategory','SubcatController');
    Route::resource('subsub','SubsubController');
    Route::resource('product','ProductController');
    Route::resource('auction','AuctionController');
    Route::resource('sales','SalesController');
    Route::resource('customer','CustomerController');
    Route::resource('shipping-cost','ShippingCostController');
    Route::resource('promotion','PromotionController');
    Route::resource('package','PackageController');
    Route::resource('cms','CmsController');
    Route::resource('agent','AgentController');
    Route::resource('offer','OfferController');
    Route::resource('delivery','DeliverydateController');
    Route::get('/customer/active/{id}','CustomerController@active');
    Route::get('/customer/inactive/{id}','CustomerController@inactive');
    Route::get('/agent/active/{id}','AgentController@active');
    Route::get('/agent/inactive/{id}','AgentController@inactive');
    Route::get('/show-product/{id}','ProductController@showProduct');
    Route::get('/latest','SalesController@neworder');
    Route::get('/update-order-status/{orderId}/{status}','SalesController@updateOrderStatus');
    Route::get('/invoice/{order_no}', 'PaymentController@generateOrderInvoiceadmin');
    Route::get('/product-report','ProductController@stock');
});

});

