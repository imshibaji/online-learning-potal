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

Route::prefix('shibaji')->group(function() {
    Route::get('/', 'ShibajiController@index');
});
Route::domain('shibajidebnath.com')->group(function(){
    Route::get('/', 'ShibajiController@index');
});
Route::group(['domain' => 'www.shibajidebnath.com'], function(){
    Route::get('/', 'ShibajiController@index');
});
