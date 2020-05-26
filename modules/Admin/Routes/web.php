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

Route::domain(modules_domain('admin'))->group(function () {

	//微信公众平台
	Route::any('wechat', 'Wechat\\WechatController@serve');
	
	//登录
	Route::namespace('Auth')->group(function () {
		Route::get('login', 'AuthController@login')->name('admin.login');
		Route::post('login', 'AuthController@doLogin')->name('admin.login.do');
    	Route::get('logout', 'AuthController@logout')->name('admin.logout');
	});

	Route::group(['middleware' => ['admin']], function () {

    	//主页
    	Route::namespace('Index')->group(function () {
	    	Route::get('/', 'IndexController@index')->name('admin');
	    	Route::get('info', 'IndexController@info')->name('admin.info');
		});

		//blog
		Route::prefix('blog')->namespace('Blog')->group(function () {
			Route::get('/', 'BlogController@index')->name('admin.blog');

			//文章
			Route::prefix('article')->group(function () {
				Route::get('/', 'ArticleController@index')->name('admin.blog.article');
				Route::get('create', 'ArticleController@create')->name('admin.blog.article.create');
				Route::post('create', 'ArticleController@store')->name('admin.blog.article.store');
				Route::get('edit/{article}', 'ArticleController@edit')->name('admin.blog.article.edit');
				Route::put('edit/{article}', 'ArticleController@update')->name('admin.blog.article.update');
				Route::delete('delete/{article}', 'ArticleController@delete')->name('admin.blog.article.delete');
				Route::post('uploadImg', 'ArticleController@uploadImg')->name('admin.blog.article.uploadImg');
			});

			//分类
			Route::prefix('category')->group(function () {
				Route::get('/', 'CategoryController@index')->name('admin.blog.category');
				Route::get('create', 'CategoryController@create')->name('admin.blog.category.create');
				Route::post('create', 'CategoryController@store')->name('admin.blog.category.store');
				Route::get('edit/{category}', 'CategoryController@edit')->name('admin.blog.category.edit');
				Route::put('edit/{category}', 'CategoryController@update')->name('admin.blog.category.update');
				Route::delete('delete/{category}', 'CategoryController@delete')->name('admin.blog.category.delete');
				Route::get('trashed', 'CategoryController@trashed')->name('admin.blog.category.trashed');
				Route::put('restore', 'CategoryController@restore')->name('admin.blog.category.restore');
				Route::delete('destory', 'CategoryController@destory')->name('admin.blog.category.destory');
			});

			//标签
			Route::prefix('tag')->group(function () {
				Route::get('/', 'TagController@index')->name('admin.blog.tag');
				Route::get('create', 'TagController@create')->name('admin.blog.tag.create');
				Route::post('create', 'TagController@store')->name('admin.blog.tag.store');
				Route::get('edit/{tag}', 'TagController@edit')->name('admin.blog.tag.edit');
				Route::put('edit/{tag}', 'TagController@update')->name('admin.blog.tag.update');
				Route::delete('delete/{tag}', 'TagController@delete')->name('admin.blog.tag.delete');
			});

			//专题
			Route::prefix('topic')->group(function () {
				Route::get('/', 'TopicController@index')->name('admin.blog.topic');
				Route::get('create', 'TopicController@create')->name('admin.blog.topic.create');
				Route::post('create', 'TopicController@store')->name('admin.blog.topic.store');
				Route::get('edit/{topic}', 'TopicController@edit')->name('admin.blog.topic.edit');
				Route::put('edit/{topic}', 'TopicController@update')->name('admin.blog.topic.update');
				Route::delete('delete/{topic}', 'TopicController@delete')->name('admin.blog.topic.delete');
			});

			//文章评论
			Route::prefix('comment')->group(function () {
				Route::get('/', 'CommentController@index')->name('admin.blog.comment');
				Route::get('create', 'CommentController@create')->name('admin.blog.comment.create');
				Route::post('create', 'CommentController@store')->name('admin.blog.comment.store');
				Route::get('edit/{comment}', 'CommentController@edit')->name('admin.blog.comment.edit');
				Route::put('edit/{comment}', 'CommentController@update')->name('admin.blog.comment.update');
				Route::delete('delete/{comment}', 'CommentController@delete')->name('admin.blog.comment.delete');
			});

			//留言板
			Route::prefix('message')->group(function () {
				Route::get('/', 'MessageController@index')->name('admin.blog.message');
				Route::get('create', 'MessageController@create')->name('admin.blog.message.create');
				Route::post('create', 'MessageController@store')->name('admin.blog.message.store');
				Route::get('edit/{message}', 'MessageController@edit')->name('admin.blog.message.edit');
				Route::put('edit/{message}', 'MessageController@update')->name('admin.blog.message.update');
				Route::delete('delete/{message}', 'MessageController@delete')->name('admin.blog.message.delete');
			});

			//友情链接
			Route::prefix('link')->group(function () {
				Route::get('/', 'LinkController@index')->name('admin.blog.link');
				Route::get('create', 'LinkController@create')->name('admin.blog.link.create');
				Route::post('create', 'LinkController@store')->name('admin.blog.link.store');
				Route::get('edit/{link}', 'LinkController@edit')->name('admin.blog.link.edit');
				Route::put('edit/{link}', 'LinkController@update')->name('admin.blog.link.update');
				Route::delete('delete/{link}', 'LinkController@delete')->name('admin.blog.link.delete');
			});

			//设置			
			Route::get('setting', 'SettingController@index')->name('admin.blog.setting');
			Route::put('setting', 'SettingController@update')->name('admin.blog.setting.update');
		});

		//wechat
		Route::prefix('wechat')->namespace('Wechat')->group(function () {

			Route::get('/index', 'WechatController@index')->name('admin.wechat');
			//菜单
			Route::get('menu', 'MenuController@index')->name('admin.wechat.menu');
		});
    });
});
