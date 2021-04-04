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

use App\Http\Controllers\Admin\ActivityController;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

$routes = function(){
    Route::get('/', 'LarnrController@index');
    Route::get('v/{id}', 'LarnrController@video');
    Route::get('search', 'LarnrController@search');

    // Auth::routes(['verify' => true]);

    Route::get('tac', function(){
        return view('larnr::tac');
    });

    Route::get('privacy', function(){
        return view('larnr::privacy');
    });

    // Activities Data Create
    Route::post('/ahoy/visits', [ActivityController::class, 'create']);

    Route::redirect('{any}', '/', 301);
};

Route::domain('larnr.com')->group($routes);
Route::group(['domain' => 'www.larnr.com'], $routes);
