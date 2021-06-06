<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Catagory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Redis::set('test', 'test app');
        // Redis::delete('test');
        // return Redis::keys('*');
        $articles = Article::orderBy('id', 'desc')->paginate(5);
        return view('admin.articles.list', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories= Catagory::all();
        $users = User::all();
        return view('admin.articles.add', compact('categories', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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

        $article->user_id = $request->user_id ?? Auth::id();
        $article->catagory_id = $request->category_id;
        $article->status = $request->status;
        $article->type = $request->type;
        $article->approved = $request->approved;
        $article->canonical = $request->canonical;
        $article->save();

        return redirect(route('article.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Article::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories= Catagory::all();
        $users = User::all();
        $article = Article::find($id);
        return view('admin.articles.edit', compact('article', 'categories', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
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

        $article->user_id = $request->user_id ?? Auth::id();
        $article->catagory_id = $request->category_id;
        $article->status = $request->status;
        $article->type = $request->type;
        $article->approved = $request->approved;
        $article->canonical = $request->canonical;
        $article->save();

        return redirect(route('article.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        // Storage::disk('public')->delete([$article->image_path]);
        $out = $article->delete();

        return [ 'status' => 200,
            'message' => 'Article Deleted',
            'out' => $out
        ];
    }
    public function deletedList(){
        $articles = Article::onlyTrashed()->paginate(5);
        // dd($articles);
        return view('admin.articles.deletedList',  compact('articles'));
    }
    public function restore($id){
        $article = Article::onlyTrashed()->where('id', $id)->firstOrFail();
        $article->restore();

        return redirect(route('article.index'));
    }
    public function forceDelete($id){
        $article = Article::onlyTrashed()->where('id', $id)->firstOrFail();
        Storage::disk('public')->delete([$article->image_path]);
        $out = $article->forceDelete();

        return [ 'status' => 200,
            'message' => 'Article Forced Deleted',
            'out' => $out
        ];
    }

    public static function routes(){
        Route::resource('article', 'ArticleController');
        Route::prefix('article')->group(function(){
            Route::get('deleted/list', 'ArticleController@deletedList')->name('adminArticleDeleteList');
            Route::post('clear/{id}', 'ArticleController@forceDelete')->name('adminArticleForcedDelete');
            Route::get('restore/{id}', 'ArticleController@restore')->name('adminArticleRestore');
        });
    }
}
