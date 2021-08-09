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
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            if(isset($user)){
                if($user->user_type != 'admin'){
                    \Debugbar::disable();
                }
            }else{
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
        $articles = Article::publish()->inRandomOrder()->get();
        $title = 'Free Tutorials Articles';
        $description = 'This section for free Software development tutorials. you can learn software development learning free way';

        return view('larnr::articles.index', compact('articles', 'title', 'description'));
    }

    public function subscribe(Request $req){
        try {
            Subscribe::updateOrCreate(
                ['email' => $req->email],
                [
                    'name' => $req->name,
                    'email' => $req->email
                ]
            );
            $req->session()->flash('status', 'Thank you for suscribe.');
            return redirect(url('/articles'));
        } catch (\Throwable $th) {
            return $th;
        }
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
        $article->views = ($article->type=='publish')? $article->views + 1: $article->views;
        $article->save();

        return view('larnr::articles.single', compact('article', 'articles'));
    }

    public function subnow(Request $req){
        // dd($req->input());
        try {
            Subscribe::updateOrCreate(
                ['email' => $req->email],
                [
                    'name' => $req->name,
                    'email' => $req->email,
                    'mobile' => $req->mobile,
                    'user_id' => $req->auid
                ]
            );

            // $req->session()->flash('status', 'Thank you for suscribe.');
            return ['status' => 'OK','message' => 'Thank you for Subscribe'];
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function likes(Request $req){
        $article = Article::find($req->id);
        $article->likes++;
        $article->save();
        return ['status' => 'OK','message' => 'Thank you for Like', 'count' => $article->likes];
    }
    public function dislikes(Request $req){
        $article = Article::find($req->id);
        $article->dislikes++;
        $article->save();
        return ['status' => 'OK','message' => 'Thank you for Dislike', 'count' => $article->dislikes];
    }
    public function share(Request $req){
        $article = Article::find($req->id);
        $article->shares++;
        $article->save();
        return ['status' => 'OK','message' => 'Thank you for Share', 'count' => $article->shares];
    }
}
