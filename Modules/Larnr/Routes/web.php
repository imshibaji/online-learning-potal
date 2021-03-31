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

use App\Http\Controllers\Admin\ActivityController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::domain('larnr.com')->group(function(){
    Route::get('/', 'LarnrController@index');
    Route::get('v/{id}', 'LarnrController@video');
    // ->middleware(['auth']);
    // Auth::routes();

    // Activities Data Create
    Route::post('/ahoy/visits', [ActivityController::class, 'create']);

    Route::redirect('{any}', '/', 301);
});
Route::group(['domain' => 'www.larnr.com'], function(){
    Route::get('/', 'LarnrController@index');
    Route::get('v/{id}', 'LarnrController@video');
    // ->middleware(['auth']);

    // Auth::routes();

    // Activities Data Create
    Route::post('/ahoy/visits', [ActivityController::class, 'create']);

    Route::redirect('{any}', '/', 301);
});
