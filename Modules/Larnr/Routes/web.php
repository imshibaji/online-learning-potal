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
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

$routes = function(){
    Route::get('/', 'LarnrController@index');
    Route::get('search', 'LarnrController@search');
    // Footers Area
    Route::get('tac', 'LarnrController@tac');
    Route::get('privacy', 'LarnrController@privacy');
    Route::get('about', 'LarnrController@about');
    Route::get('contact', 'LarnrController@contact');

    // Sitemap
    Route::get('sitemap', 'LarnrController@sitemapGen');


    Route::get('testimonial', 'TestimonialController@index');
    Route::get('sponsor', 'SponsorController@index');
    Route::get('partner', 'PartnerController@index');

    Route::get('articles', 'ArticleController@index');
    Route::get('article/{slug}', 'ArticleController@show');
    Route::post('article/comment', 'ArticleController@comment')->middleware('auth');

    Route::get('courses', 'CourseController@index');
    Route::get('course/{slug}', 'CourseController@show');
    Route::get('/course-preview/{cid}', 'CourseController@course_preview');
    Route::get('/course-preview/{cid}/{tid}', 'CourseController@course_preview');


    // Payment
    Route::get('/bill', [PaymentController::class,'bill']);
    Route::any('/payment', [PaymentController::class, 'pay']);

    // Video Controller
    Route::get('allvideos', 'VideoController@allVideos');
    // Route::get('search', 'VideoController@search');
    Route::get('v/{id}', 'VideoController@video');
    // ->middleware('auth');
    Route::post('v/comment', 'VideoController@comment')->middleware('auth');


    // Activities Data Create
    Route::post('/ahoy/visits', [ActivityController::class, 'create']);
    // Route::redirect('{any}', '/', 301);
};

Route::domain('larnr.com')->group($routes);
Route::group(['domain' => 'www.larnr.com'], $routes);
