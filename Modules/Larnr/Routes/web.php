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

// Route::prefix('larnr')->group(function() {
//     Route::get('/', 'LarnrController@index');
// });

Route::domain('larnr.com')->group(function(){
    Route::get('/', 'LarnrController@index');
});
Route::group(['domain' => 'www.larnr.com'], function(){
    Route::get('/', 'LarnrController@index');
});