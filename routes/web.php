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

Route::get('/', function () {
    return view('welcome');
});

// put patch head delete

Route::get('about', 'PublicController@about');
Route::get('terms', 'PublicController@terms');
Route::get('privacy', 'PublicController@privacy');
Route::get('contact', 'PublicController@contact');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
