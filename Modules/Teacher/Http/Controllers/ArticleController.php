<?php

namespace Modules\Teacher\Http\Controllers;

use App\Models\Article;
use App\Models\Catagory;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Modules\Teacher\Events\ArticlePublish;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $articles = Article::where('user_id', Auth::id())->orderBy('id', 'desc')->paginate(5);
        return view('teacher::articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $categories= Catagory::all();
        return view('teacher::articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $article = new Article();
        $article->title = $request->title;
        $article->slug = $request->slag;
        $article->details = $request->details;
        $article->keywords = $request->meta_keys;
        $article->description = $request->meta_desc;
        $article->video_path = $request->video;

        if($request->file('image')){
            $img = 'thumbnails/'.basename(Storage::putFile('public/thumbnails', $request->file('image')));
            $article->image_path = $img;
         }

        $article->user_id = Auth::id();
        $article->catagory_id = $request->category_id;
        $article->status = $request->status;
        $article->type = $request->type;
        $article->approved = 0;
        $article->canonical = $request->canonical;
        $article->save();

        event(new ArticlePublish($article));
        return redirect(route('teacherarticles.index'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $article = Article::find($id);
        return view('teacher::articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $categories= Catagory::all();
        $article = Article::find($id);
        return view('teacher::articles.edit', compact('categories', 'article'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        $article->title = $request->title;
        $article->slug = $request->slag;
        $article->details = $request->details;
        $article->keywords = $request->meta_keys;
        $article->description = $request->meta_desc;
        $article->video_path = $request->video;

        if($request->file('image')){
            Storage::disk('public')->delete([$article->image_path]);
            $img = 'thumbnails/'.basename(Storage::putFile('public/thumbnails', $request->file('image')));
            $article->image_path = $img;
         }

        $article->user_id = Auth::id();
        $article->catagory_id = $request->category_id;
        $article->status = $request->status;
        $article->type = $request->type;
        $article->approved = 1;
        $article->canonical = $request->canonical;
        $article->save();

        event(new ArticlePublish($article));
        return redirect(route('teacherarticles.index'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        Storage::disk('public')->delete([$article->image_path]);
        $article->delete();

        return ['did' => $id];
    }
}
