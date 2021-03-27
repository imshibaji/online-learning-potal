<?php

namespace App\Http\Controllers\Admin\Learn;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CommentController extends Controller
{
    public function getAll(){
        $comments = Comment::all();
        return $comments;
    }

    public function getByUid(Request $req){
        $comments = Comment::where('user_id', $req->uid)->get();
        return $comments;
    }

    public function new(Request $req){
        $comment = new Comment();
        $comment->user_id = $req->user_id;
        $comment->course_id = $req->course_id;
        $comment->topic_id = $req->topic_id;
        $comment->title = $req->title;
        $comment->message = $req->message;
        $comment->save();
        return back();
    }
    public function reply(Request $req){
        $comment = new Comment();
        $comment->user_id = $req->user_id;
        $comment->course_id = $req->course_id;
        $comment->topic_id = $req->topic_id;
        $comment->title = $req->title;
        $comment->message = $req->message;
        $comment->comment_id = $req->comment_id;
        $comment->save();
        return back();
    }

    public function update(Request $req)
    {
        $comment = Comment::find($req->cmt_id);
        $comment->user_id = $req->user_id;
        $comment->course_id = $req->course_id;
        $comment->topic_id = $req->topic_id;
        $comment->title = $req->title;
        $comment->message = $req->message;
        $comment->read_status = $req->read_status;
        $comment->public = $req->public_status;
        $comment->comment_id = $req->comment_id;
        $comment->save();
        return back();
    }

    public function delete(Request $req){
        $comment = Comment::find($req->cmt_id);
        $comment->delete();
        return back();
    }

    public static function routes(){
        Route::prefix('comment')->namespace('Learn')->group(function(){
            Route::get('get', 'CommentController@getAll')->name('admincomments');
            Route::get('getbyuser', 'CommentController@getByUid')->name('admincommentsbyuser');
            Route::post('new', 'CommentController@new')->name('admincommentnew');
            Route::post('update', 'CommentController@update')->name('admincommentupdate');
            Route::post('reply', 'CommentController@reply')->name('admincommentreply');
            Route::post('delete', 'CommentController@delete')->name('admincommentdelete');
        });
    }
}
