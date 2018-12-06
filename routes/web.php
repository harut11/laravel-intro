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

Route::get('/', 'PublicController@home')->middleware('lang');
Route::get('home', 'PublicController@home')->name('home')->middleware('lang');
Route::get('about', 'PublicController@about')->middleware('lang');
Route::get('terms', 'PublicController@terms')->middleware('lang');
Route::get('privacy', 'PublicController@privacy')->middleware('lang');
Route::get('contact', 'PublicController@contact')->middleware('lang');

Route::get('change-language/{code}', 'PublicController@changeLanguage');

Route::get('items', 'ItemController@index');
Route::post('items', 'ItemController@store')->middleware('auth');
Route::get('items/create', 'ItemController@create')->middleware('auth');
Route::get('items/edit/{id}', 'ItemController@edit');
Route::post('items/update/{id}', 'ItemController@update');
Route::get('items/destroy/{id}', 'ItemController@destroy');
Route::get('items/{id}', 'ItemController@show');

Auth::routes();
