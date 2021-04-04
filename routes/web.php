<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();



use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Spatie\Honeypot\ProtectAgainstSpam;

Route::group(['domain' => 'app.larnr.com'], function(){
    // Front Parts
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/signup', 'HomeController@register_page')->name('register_page');
    Route::post('/signup', 'HomeController@signup')->middleware(ProtectAgainstSpam::class)->name('signup');
    Route::post('/signin', 'HomeController@signin')->middleware(ProtectAgainstSpam::class)->name('signin');

    Route::post('/profile', 'HomeController@profile')->name('profilePost');
    Route::post('/change', 'HomeController@changePassword')->name('changePassword');

    Route::get('/about', 'HomeController@about')->name('about');
    Route::get('/plans', 'HomeController@plans')->name('plans');

    Route::get('/data', 'HomeController@data');
    Route::get('/ref-code', 'HomeController@refer_code');

    Route::get('/courses', 'HomeController@courses')->name('homecourses');
    Route::get('course/{slag}', 'HomeController@course')->name('homecourse');
    Route::get('/course-preview/{cid}', 'HomeController@course_preview')->name('homecpreview');
    Route::get('/course-preview/{cid}/{tid}', 'HomeController@course_preview')->name('hometpreview');

    // // Payment Controller
    Route::get('/bill', 'PaymentController@bill')->name('bill')->middleware('auth');
    Route::any('/payment', 'PaymentController@pay')->name('billpay')->middleware('auth');
    Route::get('/payreport', 'PaymentController@report')->middleware('auth');
    Route::get('/payreportlist', 'PaymentController@reportList')->middleware('auth');



    // Admin Chart Create
    Route::get('/ahoy/events', 'Admin\ActivityController@chartDataCreate');
    // Admin Chart
    Route::get('/ahoy/chart', 'Admin\ActivityController@chartPrepaire');

    // Activities Data Create
    Route::post('/ahoy/visits', 'Admin\ActivityController@create');
    // Activities Data cleaning
    Route::get('/del_activity', 'Admin\ActivityController@delete');

    Route::get('/jobs', 'HomeController@jobs');

    Route::get('/job-details', 'HomeController@jobDetails');

    Route::get('/candidates', 'HomeController@candidates');

    Route::get('/cand-details', 'HomeController@candDetails');

    Route::get('/add', 'HomeController@add');


    Route::get('/get', 'HomeController@getUsers');


    Route::get('/make', 'ManageController@index');
    Route::get('/make/{$name}', 'ManageController@make');
    Route::get('/migration', 'ManageController@migrate');


    Auth::routes(['verify' => true]);
    // Auth::routes();

    Route::redirect('/register', '/signup', 301);

    NotificationController::routes();

    // API
    Route::prefix('api')->group(function(){
        Route::get('info', 'HomeController@userActivityInfo');
        Route::get('admininfo','HomeController@adminActivityInfo');
    });

    Route::get('/api_gen/{id}', 'HomeController@apiGen');

    // Admin Routes
    Route::middleware(['auth', 'checkadmin'])->prefix('admin')
    ->namespace('Admin')->group(base_path('routes/admin.php'));

    // Users Routes
    Route::middleware(['auth'])->prefix('user')
    ->namespace('User')->group(base_path('routes/users.php'));


    // Route::get('{any}', function(){
    //     return redirect()->route('user');
    // });
    Route::redirect('{any}', 'user', 301);

    Route::fallback('HomeController@error');

});
