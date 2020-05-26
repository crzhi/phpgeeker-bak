<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::domain(modules_domain('mall'))->group(function () {

	//首页
	Route::prefix('/')->namespace('Index')->group(function () {
		Route::get('/', 'IndexController@index')->name('mall');
	});

	//分类
	// Route::prefix('category')->namespace('Category')->group(function () {
	// 	Route::get('{category}', 'CategoryController@index')->name('mall.category.index');
	// });

	//商品
	Route::prefix('products')->namespace('Products')->group(function () {
		Route::get('/', 'ProductsController@index')->name('mall.products.index');
		Route::get('{product}', 'ProductsController@show')->name('mall.products.show');
	});

	//购物车
	Route::prefix('cart')->namespace('Cart')->group(function () {
		Route::get('/', 'CartController@index')->name('mall.cart');
	});

	Route::group(['middleware' => ['auth']], function () {

		//用户中心
		Route::prefix('user')->namespace('User')->group(function () {

			//用户主页
			Route::get('/', 'UserController@index')->name('mall.user');

			//用户地址
			Route::prefix('address')->group(function () {
				Route::get('/', 'AddressController@index')->name('mall.user.address');
				Route::get('create', 'AddressController@create')->name('mall.user.address.create');
				Route::post('create', 'AddressController@store')->name('mall.user.address.store');
				Route::get('edit/{address}', 'AddressController@edit')->name('mall.user.address.edit');
				Route::put('edit/{address}', 'AddressController@update')->name('mall.user.address.update');
				Route::delete('delete/{address}', 'AddressController@delete')->name('mall.user.address.delete');
				Route::get('region/{id?}', 'AddressController@region')->name('mall.user.address.region');
			});

			//收藏
			Route::get('favorite', 'FavoriteController@index')->name('mall.user.favorite');
			
			//订单
			Route::prefix('orders')->group(function () {
				Route::get('/', 'OrdersController@index')->name('mall.user.orders');
				Route::get('{order}', 'OrdersController@show')->name('mall.user.orders.show');
				Route::post('{order}/received', 'OrdersController@received')->name('mall.user.orders.received');
	            Route::get('{order}/review', 'OrdersController@review')->name('mall.user.orders.review.show');
	            Route::post('{order}/review', 'OrdersController@sendReview')->name('mall.user.orders.review.store');
	            Route::post('{order}/apply_refund', 'OrdersController@applyRefund')->name('mall.user.orders.apply_refund');
	        });

		});

		//收藏
		Route::prefix('products')->namespace('User')->group(function () {
		    Route::post('{product}/favor', 'FavoriteController@favor')->name('mall.products.favor');
	    	Route::delete('{product}/favor', 'FavoriteController@disfavor')->name('mall.products.favor');
		});

		//购物车
		Route::prefix('cart')->namespace('Cart')->group(function () {
			Route::post('add', 'CartController@add')->name('mall.cart.add');
			Route::post('update/{sku}', 'CartController@update')->name('mall.cart.update');
			Route::delete('delete/many', 'CartController@deleteMany')->name('mall.cart.deletemany');
			Route::delete('delete/{sku}', 'CartController@delete')->name('mall.cart.delete');
		});

		//订单
		Route::prefix('orders')->namespace('Orders')->group(function () {
			Route::post('item/confirm', 'OrdersController@itemConfirm')->name('mall.orders.item.confirm');
			Route::post('cart/confirm', 'OrdersController@cartConfirm')->name('mall.orders.cart.confirm');
			Route::post('orders', 'OrdersController@store')->name('mall.orders.store');
		});

		//支付
		Route::prefix('pay')->namespace('Pay')->group(function () {
			Route::get('type/{order}', 'PayController@payType')->name('mall.pay.type');
			Route::get('{order}/alipay', 'PayController@payByAlipay')->name('mall.pay.alipay');
			Route::get('alipay/return', 'PayController@alipayReturn')->name('mall.pay.alipay.return');
		});
	});
	//支付异步通知
	Route::post('pay/alipay/notify', 'Pay\\PayController@alipayNotify')->name('mall.pay.alipay.notify');
});
