<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseAssignment;
use App\Models\Learning;
use App\Models\TopicAssignment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AssignController extends Controller
{
    public function data(Request $req){
        $user = User::find($req->uid ?? 1);
        $assign = $user->assignments;

        return $assign;
    }
    
    public function checkCourseAssignment(Request $req){
        $assign = CourseAssignment::where('user_id', $req->uid)->get();
        return $assign;
    }

    public function checkTopicAssignment(Request $req){
        $assign = TopicAssignment::where('user_id', $req->uid)->get();
        return $assign;
    }

    public function course_assign(Request $req){
        $ca = CourseAssignment::firstOrCreate([
            'user_id'=> $req->uid, 
            'course_id' => $req->cid
        ]);
        $ca->save();
        return $ca->id;
    }

    public function course_unassign(Request $req){
        $assign = CourseAssignment::where('user_id', $req->uid)->where('course_id', $req->cid)->first();
        $assign->delete(); 
    }

    public function topic_assign(Request $req){
        $ta = TopicAssignment::firstOrCreate([
            'user_id'=> $req->uid,
            'topic_id' => $req->tid
        ]);
        $ta->save();
        return $ta->id;
    }

    public function topic_unassign(Request $req){
        $assign = TopicAssignment::where('user_id', $req->uid)->where('topic_id', $req->tid)->first();
        $assign->delete();
    }

    public static function routes(){
        Route::prefix('assign')->group(function(){
            Route::get('course', 'AssignController@course_assign')->name('courseassign');
            Route::get('courseunset', 'AssignController@course_unassign')->name('courseassignunset');
        
            Route::get('topic', 'AssignController@topic_assign')->name('topicassign');
            Route::get('topicunset', 'AssignController@topic_unassign')->name('topicassignunset');
        
            Route::get('noset', 'AssignController@noassign')->name('noassign');
            Route::get('check', 'AssignController@checkCourseAssignment')->name('assigncheck');
            
            Route::get('data', 'AssignController@data')->name('assigndata');
            Route::post('learning', 'LearningController@create_update')->name('assignlearning');
        });
    }
}
