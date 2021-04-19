<?php

namespace Modules\Larnr\Http\Controllers;

use App\Models\Comment;
use App\Models\Video;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function __construct()
    {
        \Debugbar::disable();
    }

    public function video($id){
        $video = Video::find(base64_decode($id));
        $videos = Video::inRandomOrder()->limit(4)->get();
        $title = $video->title;
        $keywords = $video->keywords;
        $description = $video->description;
        $og_type = null;
        $og_url = url('v/'. base64_encode($video->id));
        $og_image= url('storage/'.$video->image_path);
        $og_video = url('storage/'.$videos[0]->video_path);
        $author = ($video->user)? $video->user->fname .' '. $video->user->lname : null;

        // $video->views = ($video->type=='publish')? $video->views + rand(1,10) : $video->views;
        $video->views = $video->views + rand(1,10);
        $video->save();


        return view('larnr::videos.single', compact('video', 'videos', 'title',
        'keywords', 'description','og_type', 'og_url', 'og_image', 'og_video', 'author'));
    }

    // public function search(Request $request){
    //     $terms = $request->query('q', 'intro');
    //     $videos = Video::where('title', 'LIKE', '%'.$terms.'%')->orWhere('keywords', 'LIKE', '%'.$terms.'%')->get();
    //     $title = $terms;
    //     // dd($videos);
    //     if(count($videos) > 0){
    //         $title = $videos[0]->title;
    //         $keywords = $videos[0]->keywords;
    //         $description = $videos[0]->description;
    //         $og_url = $request->url();
    //         $og_image= url('storage/'.$videos[0]->image_path);
    //         $og_video = url('storage/'.$videos[0]->video_path);
    //     }else{
    //         $keywords = 'search video, learning videos, tutorials, videos';
    //         $description = 'You can search learning videos.';
    //         $og_url = $request->url();
    //         $og_image= url('images/screen.png');
    //         $og_video = url('videos/intro.mp4');
    //     }
    //     return view('larnr::videos.search', compact('videos', 'title', 'keywords',
    //     'description', 'og_url', 'og_image', 'og_video'));
    // }

    public function allVideos(){
        $videos = Video::inRandomOrder()->publish()->get();
        $title = 'Free Tutorials Videos';
        $description = 'This section for free Software development tutorials video. you can learn software development learning free way';
        return view('larnr::videos.list', compact('videos', 'title'));
    }

    public function comment(Request $request){
        $vid = Video::find(base64_decode($request->input('vid')));
        $comment = new Comment();
        $comment->message = $request->message;
        $comment->user_id = Auth::id();
        $vid->comments()->save($comment);

        session()->flash('status', 'Your comment posted Successfully.');
        return back();
    }
}
