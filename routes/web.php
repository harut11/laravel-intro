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

Route::get('/', 'PublicController@home');
Route::get('home', 'PublicController@home')->name('home');
Route::get('about', 'PublicController@about');
Route::get('terms', 'PublicController@terms');
Route::get('privacy', 'PublicController@privacy');
Route::get('contact', 'PublicController@contact');

Route::get('items', 'ItemController@index');
<<<<<<< HEAD
Route::post('items', 'ItemController@store');
Route::get('items/create', 'ItemController@create');
Route::get('items/edit/{id}', 'ItemController@edit');
Route::post('items/update{id}', 'ItemController@update');
Route::get('items/destroy/{id}', 'ItemController@destroy');
=======
Route::post('items', 'ItemController@store')->middleware('auth');
Route::get('items/create', 'ItemController@create')->middleware('auth');
>>>>>>> 23f849758d70c6c485c831956f68de7870423431
Route::get('items/{id}', 'ItemController@show');

Auth::routes();
