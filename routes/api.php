<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'items', 'namespace' => 'Api', 'as' => 'api.item'], function() {
	Route::get('/', 'ItemController@index')->name('index');
	Route::get('{model}', 'ItemController@show')->name('show');
	Route::post('/', 'ItemController@store')->name('store');
	Route::put('{model}', 'ItemController@update')->name('update');
	Route::delete('{model}', 'ItemController@destroy')->name('delete');
});