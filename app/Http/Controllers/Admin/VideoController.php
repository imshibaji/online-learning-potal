<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\ConvertVideoForStreaming;
use App\Models\Catagory;
use App\Models\Course;
use App\Models\User;
use App\Models\Video;
use FFMpeg\Filters\Video\VideoFilters;
use FFMpeg\Format\Video\X264;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::orderBy('id', 'desc')->paginate(8);
        $title = 'Video List';
        return view('admin.videos.list', compact('videos', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.videos.add', [
            'title' => 'Video Uploader',
            'categories' => Catagory::all(),
            'users' => User::all(),
        ]);
        // return phpinfo();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vid = new Video();
        $vid->title = $request->input('title');
        $vid->slug = $request->input('slag');

        $video_data = $this->video($request);
        $vid->image_path = $video_data['thumb'];
        $vid->video_path = $video_data['video'];

        $vid->keywords = $request->input('meta_keys');
        $vid->description = $request->input('meta_desc');
        $vid->details = $request->input('details');
        $vid->catagory_id = $request->input('category_id');
        $vid->user_id = $request->input('user_id');
        $vid->status = $request->input('status');
        $vid->type = $request->input('type');
        $vid->approved = $request->approved;
        $vid->canonical = $request->canonical;

        $vid->save();

        return redirect()->route('video.index');
    }

    public function video(Request $request){
        $video = $img = null;

        if($request->file('video')){
            $path = basename(Storage::putFile(
                'public/videos', $request->file('video')
            ));
            $video = 'videos/'.$path;
        }

        if($request->file('image')){
           $img = 'thumbnails/'.basename(Storage::putFile('public/thumbnails', $request->file('image')));
        }else if($request->file('video')){
            $img = 'thumbnails/'.Str::random(16).'.png';
            FFMpeg::fromDisk('public')
            ->open('videos/'.$path)
            ->getFrameFromSeconds(10)
            ->export()
            ->toDisk('public')
            ->save($img);
        }

        return ['video' => $video, 'thumb' => $img ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $video = Video::find($id);
        $videos = Video::all();
        $title = $video->title;

        // Not used now
        // $this->dispatch(new ConvertVideoForStreaming($video));

        // $streamUrl = Storage::disk('streamable_videos')->url('streams/'.$video->id . '.m3u8');
        // dd($streamUrl);

        return view('admin.videos.view', compact('video', 'videos', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.videos.edit', [
            'title' => 'Video Uploader',
            'video' => Video::find($id),
            'categories' => Catagory::all(),
            'users' => User::all(),
        ]);
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
        $vid = Video::find($id);
        $vid->title = $request->input('title');
        $vid->slug = $request->input('slag');

        if($request->file('video')){
            Storage::disk('public')->delete([$vid->image_path, $vid->video_path]);
        }
        if($request->file('image')){
            Storage::disk('public')->delete([$vid->image_path]);
        }
        $video_data = $this->video($request);
        $vid->image_path = $video_data['thumb'] ?? $vid->image_path;
        $vid->video_path = $video_data['video'] ?? $vid->video_path;


        $vid->keywords = $request->input('meta_keys');
        $vid->description = $request->input('meta_desc');
        $vid->details = $request->input('details');
        $vid->catagory_id = $request->input('category_id');
        $vid->user_id = $request->input('user_id');
        $vid->status = $request->input('status');
        $vid->type = $request->input('type');
        $vid->approved = $request->approved;
        $vid->canonical = $request->canonical;

        $vid->save();

        return redirect()->route('video.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vid = Video::find($id);
        // Storage::disk('public')->delete([$vid->image_path, $vid->video_path]);
        $vid->delete();

        return redirect()->route('video.index');
    }

    public function deletedList(){

    }
    public function restore($id){

    }
    public function forceDelete($id){

    }

    public static function routes(){
        Route::resource('video', 'VideoController');
    }
}
