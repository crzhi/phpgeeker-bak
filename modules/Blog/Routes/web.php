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

Route::domain(modules_domain('blog'))->group(function () {
	//首页
	Route::get('/', 'IndexController@index')->name('blog');

	//文章
	Route::prefix('article')->group(function () {
		Route::get('{article}', 'ArticleController@index')->name('blog.article');
		Route::post('comment/{article}', 'CommentController@comment')->name('blog.article.comment');
		Route::post('respond/{article}', 'CommentController@respond')->name('blog.article.respond');
		Route::post('recomment/{article}', 'CommentController@recomment')->name('blog.article.recomment');
	});

	//分类
	Route::prefix('category')->group(function () {		
		Route::get('/', 'CategoryController@index')->name('blog.categories');
		Route::get('{category}', 'CategoryController@category')->name('blog.category');
	});

	//标签
	Route::prefix('tag')->group(function () {
		Route::get('/', 'TagController@index')->name('blog.tags');	
		Route::get('{tag}', 'TagController@tag')->name('blog.tag');
	});

	//专题
	Route::prefix('topic')->group(function () {
		Route::get('/', 'TopicController@index')->name('blog.topics');	
		Route::get('{topic}', 'TopicController@topic')->name('blog.topic');
	});

	//留言板
	Route::prefix('message')->group(function () {
		Route::get('/', 'MessageController@index')->name('blog.message');
		Route::post('comment', 'MessageController@comment')->name('blog.message.comment');
		Route::post('respond', 'MessageController@respond')->name('blog.message.respond');
		Route::post('recomment', 'MessageController@recomment')->name('blog.message.recomment');
	});

	//友情链接
	Route::get('links', 'LinksController@index')->name('blog.links');

	//文章归档
	Route::get('archives', 'ArchivesController@index')->name('blog.archives');

	//搜索
	Route::get('search', 'SearchController@index')->name('blog.search');

	//404
	Route::get('/404', 'ErrorController@error404')->name('blog.404');
});
