<?php

// User Section

use Illuminate\Support\Facades\Route;

Route::get('/', 'UserController@index')->name('user');
Route::get('courses', 'UserController@courses')->name('usercourses');
Route::get('course/{id}', 'UserController@course')->name('usercourse');

// Video
Route::get('video/{slug}', 'UserController@video')->name('uservideo');

// Before checkout
Route::get('course-preview/{id}', 'UserController@course_preview')->name('usercpreview');
Route::get('course-preview/{id}/{tid}', 'UserController@course_preview')->name('usertpreview');

// After checkout
Route::get('my-courses', 'UserController@my_courses')->name('userMyCourses');
Route::get('course-details/{id}', 'UserController@course_details')->name('usercdetails');
Route::get('course-details/{id}/{tid}', 'UserController@course_details')->name('usertdetails');

// After learning tasks
Route::post('assesment', 'UserController@assesment')->name('userassesment');
Route::get('retry/{tid}', 'UserController@retry')->name('userretry');

// Not Required it will be used in feuture
Route::get('learn', 'UserController@learn')->name('userlearn');
Route::get('reports', 'UserController@reports')->name('userreports');
Route::get('jobs', 'UserController@jobs')->name('userjobs');

// Not Requires now
Route::get('transaction', 'TransactionController@index')->name('transactions');
Route::get('gems', 'TransactionController@gems')->name('usergems');

Route::get('/profile', 'UserController@profile')->name('profile');
