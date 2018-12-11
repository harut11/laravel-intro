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

Route::group(['middleware' => 'lang'], function() {
	Route::get('/', 'PublicController@home');
	Route::get('home', 'PublicController@home')->name('home');
	Route::get('about', 'PublicController@about');
	Route::get('terms', 'PublicController@terms');
	Route::get('privacy', 'PublicController@privacy');
	Route::get('contact', 'PublicController@contact');

	Route::group(['prefix' => 'ads', 'as' => 'items.'], function() {
		Route::get('/{owner?}', 'ItemController@index')->name('index')->where(['owner' => 'mine']);
		Route::post('/', 'ItemController@store')->middleware('auth')->name('store');
		Route::get('create', 'ItemController@create')->middleware('auth')->name('create');
		Route::get('{id}/edit', 'ItemController@edit')->name('edit');
		Route::put('{id}', 'ItemController@update')->name('update');
		Route::delete('{id}', 'ItemController@destroy')->name('delete');
		Route::get('{id}/{slug?}', 'ItemController@show')->name('show');
	});

	Route::get('profile', 'ProfileController@edit')->name('user.profile')->middleware('auth');
	Route::put('profile', 'ProfileController@update')->name('user.profile')->middleware('auth');

	Auth::routes();
});

Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function() {
	Route::group(['prefix' => 'item', 'as' => 'item.'], function() {
		Route::get('/', 'ItemController@index')->name('index');
		Route::get('create', 'ItemController@create')->name('create');
		Route::post('/', 'ItemController@store')->name('store');
		Route::get('edit/{id}', 'ItemController@edit')->name('edit');
		Route::put('{id}', 'ItemController@update')->name('update');
		Route::delete('{id}', 'ItemController@destroy')->name('delete');
		Route::get('{id}', 'ItemController@show')->name('show');
	});
});

Route::get('change-language/{code}', 'PublicController@changeLanguage')->name('change-language');

