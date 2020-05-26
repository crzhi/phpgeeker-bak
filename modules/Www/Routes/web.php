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

Route::domain(modules_domain())->group(function () {
	Route::get('/', 'WwwController@index')->name('www');
	Route::post('/image', 'WwwController@image')->name('www.image');
});

Route::domain(modules_domain('www'))->group(function () {
	Route::redirect('{all?}', modules_domain());
});