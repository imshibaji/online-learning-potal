<?php

namespace Modules\Larnr\Http\Controllers;

use App\Models\Video;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LarnrController extends Controller
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
        $videos = Video::inRandomOrder()->limit(8)->get();
        // return $videos;
        return view('larnr::index', compact('videos'));
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


        return view('larnr::video', compact('video', 'videos', 'title',
        'keywords', 'description','og_type', 'og_url', 'og_image', 'og_video'));
    }

    public function search(Request $request){
        $terms = $request->query('q', 'intro');
        $videos = Video::where('title', 'LIKE', '%'.$terms.'%')->orWhere('keywords', 'LIKE', '%'.$terms.'%')->get();
        $title = $terms;
        // dd($videos);
        if(count($videos) > 0){
            $title = $videos[0]->title;
            $keywords = $videos[0]->keywords;
            $description = $videos[0]->description;
            $og_url = $request->url();
            $og_image= url('storage/'.$videos[0]->image_path);
            $og_video = url('storage/'.$videos[0]->video_path);
        }else{
            $keywords = 'search video, learning videos, tutorials, videos';
            $description = 'You can search learning videos.';
            $og_url = $request->url();
            $og_image= url('images/screen.png');
            $og_video = url('videos/intro.mp4');
        }
        return view('larnr::search', compact('videos', 'title', 'keywords',
        'description', 'og_url', 'og_image', 'og_video'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('larnr::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('larnr::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('larnr::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
