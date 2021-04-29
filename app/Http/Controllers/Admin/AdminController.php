<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function __construct()
    {
       // $this->middleware(['auth', 'checkadmin']);
    }

    public function index(){
        return view('admin.home', ['title' => 'My Admin Dashboard']);
    }

    public function users(){
        return User::orderBy('id', 'DESC')->get();
    }

    public function profile(){
        return view('admin.profile');
    }

    // Comments List
    public function comment_list(){
        $comments = Comment::all();
        return view('admin.learn.comments.list', ['title' => 'Comment List', 'comments' => $comments]);
    }
    public function comment_add(){
        return view('admin.learn.comments.add', ['title' => 'Comment Add']);
    }

    public function comment_edit(){
        return view('admin.learn.comments.edit', ['title' => 'Comment Edit']);
    }

    public function comment_view(){
        return view('admin.learn.comments.view', ['title' => 'Comment View']);
    }

    public function comment_delete(){
        return ['title'=>'Comment Delete Section'];
    }

}
