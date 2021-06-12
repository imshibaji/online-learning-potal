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
use Modules\Teacher\Events\ActivityEvent;

Route::domain('teacher.larnr.com')->name('teacher')
->middleware(['auth','verified'])->group(function() {

    Route::get('/create', 'TeacherController@create')->name('.create');
    Route::post('/create', 'TeacherController@store')->name('.store');

    Route::get('publish/{msg}', function ($msg) {
        event(new ActivityEvent($msg));
    });

    Route::middleware('teacher')->group(function () {
        Route::get('/', 'TeacherController@index')->name('.home');
        Route::get('/profile', 'TeacherController@profile')->name('.profile');
        Route::put('/update/{id}', 'TeacherController@update')->name('.update');

        // Course Controller
        Route::resource('courses', 'CourseController');
        Route::post('courses/short', 'CourseController@short')->name('courses.short');

        // Topics Controller
        Route::resource('topics', 'TopicController');
        Route::post('topics/short', 'TopicController@short')->name('topics.short');

        // Question Controller
        Route::resource('questions', 'QuestionController');


        // Article Controller
        Route::resource('articles', 'ArticleController');

        // Comment Controller
        Route::resource('comments', 'CommentController');

        // Videos
        Route::get('/allvideos', function(){ return view('teacher::videos.index'); })->name('.videos');
        // Unknown Page
        Route::get('/{page}', 'TeacherController@page')->name('.page');
    });

    // Activities Data Create
    Route::post('/ahoy/visits', [ActivityController::class, 'create'])->name('.visits');
});
