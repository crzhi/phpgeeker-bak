<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::domain(modules_domain('passport'))->group(function () {

	//首页
	Route::get('/', function () {
	    return redirect(route('www'));
	});

	//登录
	Route::prefix('login')->group(function () {
		Route::get('/', 'LoginController@showLoginForm')->name('login');
		Route::post('/', 'LoginController@login')->name('login.do');
	});

	//退出
	Route::get('logout', 'LoginController@logout')->name('logout');

	//注册
	Route::prefix('register')->group(function () {
		Route::get('/', 'RegisterController@showRegistrationForm')->name('register');
		Route::post('/', 'RegisterController@register')->name('register.do');
	});

	//社交账号登录
	Route::prefix('oauth')->group(function () {
		//qq
		Route::get('qq', 'OAuthController@qqLogin')->name('login.qq');
		Route::get('qq/callback', 'OAuthController@qqCallback')->name('login.qq.callback');
		//wechat
		Route::post('wechat/qrcode', 'OAuthController@wechatQrcode')->name('login.wechat.qrcode');
		Route::post('wechat/check', 'OAuthController@wechatCheck')->name('login.wechat.check');
		//weibo
		Route::get('weibo', 'OAuthController@weiboLogin')->name('login.weibo');
		Route::get('weibo/callback', 'OAuthController@weiboCallback')->name('login.weibo.callback');
		Route::get('weibo/cancle', 'OAuthController@weiboCancle')->name('login.weibo.cancle');
		//github
		Route::get('github', 'OAuthController@githubLogin')->name('login.github');
		Route::get('github/callback', 'OAuthController@githubCallback')->name('login.github.callback');
	});

	//TO-DO
	//重置密码
	// Route::prefix('password')->group(function () {
	// 	Route::get('reset/{token?}', 'PasswordController@showResetForm')->name('pwdreset');
	// 	Route::post('reset', 'PasswordController@reset')->name('pwdreset.do');
	// 	Route::post('email', 'PasswordController@sendResetLinkEmail')->name('pwdreset.email');
	// });
});