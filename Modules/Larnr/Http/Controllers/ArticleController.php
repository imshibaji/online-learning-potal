<?php

namespace Modules\Larnr\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Subscribe;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function __construct()
    {
        \Debugbar::disable();
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $articles = Article::publish()->inRandomOrder()->get();
        $title = 'Free Tutorials Articles';
        $description = 'This section for free Software development tutorials. you can learn software development learning free way';

        return view('larnr::articles.index', compact('articles', 'title', 'description'));
    }

    public function subscribe(Request $req){
        Subscribe::updateOrCreate(
        ['email' => $req->email],
        [
            'name' => $req->name,
            'email' => $req->email
        ]);
        $req->session()->flash('status', 'Thank you for suscribe.');
        return redirect(url('/articles'));
    }

    public function comment(Request $request){
        $aid = Article::find(base64_decode($request->input('aid')));
        $comment = new Comment();
        $comment->message = $request->message;
        $comment->user_id = Auth::id();
        $aid->comments()->save($comment);

        session()->flash('status', 'Your comment posted Successfully.');
        return back();
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)->first();
        $articles = Article::inRandomOrder()->publish()->limit(4)->get();

        if(!isset($article->title)){
            return redirect('/articles', 301);
        }
        // $video->views = ($video->type=='publish')? $video->views + rand(1,10) : $video->views;
        $article->views = $article->views + 1;
        $article->save();

        return view('larnr::articles.single', compact('article', 'articles'));
    }
}
