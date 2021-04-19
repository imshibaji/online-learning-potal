<?php

//////////////////////
/// Admin Sections ///
//////////////////////

use App\Http\Controllers\Admin\ApiController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\AssignController;
use App\Http\Controllers\Admin\GemsController;
use App\Http\Controllers\Admin\Learn\CatagoryController;
use App\Http\Controllers\Admin\Learn\CommentController;
use App\Http\Controllers\Admin\LearningController;
use App\Http\Controllers\Admin\MoneyController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VideoController;
use Illuminate\Support\Facades\Route;

// Route::redirect('admin', '/admin', 301);

Route::get('/', 'AdminController@index')->name('admin');
Route::get('profile', 'AdminController@profile')->name('admin-profile');

ApiController::routes();

// Users Section

UserController::routes();

LearningController::routes();

MoneyController::routes();

GemsController::routes();

AssignController::routes();

VideoController::routes();

ArticleController::routes();

Route::prefix('learn')->group(function(){
    // Catagory Section
    CatagoryController::routes();

    // Course Section
    Route::prefix('course')->group(function(){
        Route::get('list', 'Learn\CourseController@list')->name('admincourselist');
        Route::get('rearrange', 'Learn\CourseController@rearrange')->name('admincourserearrange');
        Route::get('add', 'Learn\CourseController@add')->name('admincourseadd');
        Route::post('create', 'Learn\CourseController@create')->name('admincoursecreate');
        Route::get('edit/{id}', 'Learn\CourseController@edit')->name('admincourseedit');
        Route::post('update', 'Learn\CourseController@update')->name('admincourseupdate');
        Route::get('view/{id}', 'Learn\CourseController@view')->name('admincourseview');
        Route::post('delete/{id}', 'Learn\CourseController@delete')->name('admincoursedelete');
        Route::post('short', 'Learn\CourseController@short')->name('admincourseshort');
    });


    // Topics Section
    Route::prefix('topic')->group(function(){
        Route::get('list', 'Learn\TopicController@list')->name('admintopiclist');
        Route::get('add', 'Learn\TopicController@add')->name('admintopicadd');
        Route::post('create', 'Learn\TopicController@create')->name('admintopiccreate');
        Route::get('edit/{topic}', 'Learn\TopicController@edit')->name('admintopicedit');
        Route::post('update', 'Learn\TopicController@update')->name('admintopicupdate');
        Route::get('view/{topic}', 'Learn\TopicController@view')->name('admintopicview');
        Route::post('delete/{topic}', 'Learn\TopicController@delete')->name('admintopicdelete');
        Route::post('short', 'Learn\TopicController@short')->name('admintopicshort');
    });


    // Question Section
    Route::prefix('question')->group(function(){
        Route::get('topic/{id}', 'Learn\QuestionController@topic_by_course')->name('admingettopics');
        Route::get('list', 'Learn\QuestionController@list')->name('adminquestionlist');
        Route::get('add', 'Learn\QuestionController@add')->name('adminquestionadd');
        Route::post('create', 'Learn\QuestionController@create')->name('adminquestioncreate');
        Route::get('edit/{id}', 'Learn\QuestionController@edit')->name('adminquestionedit');
        Route::post('update', 'Learn\QuestionController@update')->name('adminquestionupdate');
        Route::get('view/{id}', 'Learn\QuestionController@view')->name('adminquestionview');
        Route::post('delete/{question}', 'Learn\QuestionController@delete')->name('adminquestiondelete');
        Route::post('short', 'Learn\QuestionController@short')->name('adminquestionshort');
    });

    CommentController::routes();

    // Comments Section
    Route::prefix('comment')->group(function(){
        Route::get('list', 'AdminController@comment_list')->name('admincommentlist');
      /*
        Route::get('add', 'AdminController@comment_add')->name('admincommentadd');
        Route::get('edit', 'AdminController@comment_edit')->name('admincommentedit');
        Route::get('view', 'AdminController@comment_view')->name('admincommentview');
        Route::get('delete', 'AdminController@comment_delete')->name('admincommentdelete');
        */
    });
});
// End Learn Section Route














