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
use Illuminate\Support\Facades\Route;

Route::domain('teacher.larnr.com')->name('teacher')->group(function() {
    Route::middleware('auth')->group(function () {
        Route::get('/', 'TeacherController@index')->name('.home');
        Route::post('/create', 'TeacherController@store')->name('.create');
        Route::put('/update', 'TeacherController@update')->name('.update');

        // Course Controller
        Route::resource('courses', 'CourseController');

        // Topics Controller
        Route::resource('topics', 'TopicController');

        // Question Controller
        Route::resource('questions', 'QuestionController');


        // Article Controller
        Route::resource('articles', 'ArticleController');


        // Videos
        Route::get('/allvideos', function(){ return view('teacher::videos.index'); })->name('.videos');
        // Unknown Page
        Route::get('/{page}', 'TeacherController@page')->name('.page');
    });

    // Activities Data Create
    Route::post('/ahoy/visits', [ActivityController::class, 'create'])->name('.visits');
});
