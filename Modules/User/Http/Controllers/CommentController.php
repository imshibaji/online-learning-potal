<?php

namespace Modules\User\Http\Controllers;

use App\Models\Comment;
use App\Models\Topic;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            if($user->user_type != 'admin'){
                \Debugbar::disable();
            }
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('user::index');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {
        if($req->cid != 0){
            $comment = Comment::find($req->cid);
        }else{
            $comment = new Comment();
        }
        $comment->message = $req->message;
        $comment->user_id = Auth::id();

        if($req->rid != 0){
            $comment->comment_id = $req->rid;
            $comment->save();
        }else if($req->cid != 0){
            $comment->save();
        }else{
            $topic = Topic::find($req->tid);
            $topic->comments()->save($comment);
        }

        // dd($topic->comments);

        session()->flash('status', 'Your comment posted Successfully.');
        return back();
    }

    public function delete(Request $req){
        // dd($req->cid);
        $comment = Comment::find($req->cid);
        $comment->delete();

        session()->flash('status', 'Your comment deleted Successfully.');
        return [
            'status' => 200,
            'message'=> 'Comment is deleted..',
            'out' => $comment->id
        ];
    }
}
