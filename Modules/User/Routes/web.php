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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->name('user1')
->middleware(['auth','verified'])->group(function() {
    Route::get('/', 'UserController@index');
    Route::get('/my-courses', 'UserController@my_courses')->name('.MyCourses');
    Route::get('/course-details/{id}/{tid?}', 'UserController@course_details')->name('.details');

    // Comments Section
    Route::post('topic-comment', 'CommentController@store')->name('.topic.comment');
    Route::post('comment-delete', 'CommentController@delete')->name('.comment.delete');

    Route::get('videotracker', 'UserController@videoTracker')->name('.video.time');
});
