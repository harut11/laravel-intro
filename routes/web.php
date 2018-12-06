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

	// Route::resource('items', 'ItemController');

	Route::group(['prefix' => 'items'], function() {
		Route::get('/', 'ItemController@index');
		Route::post('/', 'ItemController@store')->middleware('auth');
		Route::get('create', 'ItemController@create')->middleware('auth');
		Route::get('{id}/edit', 'ItemController@edit');
		Route::put('{id}', 'ItemController@update');
		Route::delete('{id}', 'ItemController@destroy');
		Route::get('{id}', 'ItemController@show');
	});

	Auth::routes();
});

Route::get('change-language/{code}', 'PublicController@changeLanguage');

