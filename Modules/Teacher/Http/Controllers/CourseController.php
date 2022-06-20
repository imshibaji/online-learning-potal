<?php

namespace Modules\Teacher\Http\Controllers;

use App\Models\Catagory;
use App\Models\Course;
use App\Models\Video;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
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
        $courses = Course::where('user_id', Auth::id())->orderBy('short')->get();
        // return $courses;
        return view('teacher::courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $catagories = Catagory::publish()->get();
        return view('teacher::courses.create', compact('catagories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {
        $course = new Course();
        $course->title = $req->input('title');
        $course->embed_code = $req->input('embed_code');

        if($req->file('image')){
            $img = 'thumbnails/'.basename(Storage::putFile('public/thumbnails', $req->file('image')));
            $course->image_path = $img;
         }

        $course->catagory_id = $req->input('catagory_id');
        $course->slag = $req->input('slag');
        $course->meta_keys = $req->input('meta_keys');
        $course->meta_desc = $req->input('meta_desc');
        $course->details = (string) $req->input('details');
        $course->duration = $req->input('duration');
        $course->language = $req->input('language');
        $course->status = $req->input('status');
        $course->accessible = $req->input('accessible');
        $course->actual_price = $req->input('actual_price');
        $course->offer_price = $req->input('offer_price');
        $course->user_id = Auth::id();
        $course->canonical = $req->canonical;
        $course->mode = $req->mode;
        $course->session_time = $req->session_time;

        $out = $course->save();

        if($req->vid){
            $video = Video::findOrFail($req->vid);
            $course->video()->save($video);
        }


        // $course = Course::create($req->all());

        return redirect(route('teachercourses.edit', $course->id));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $course = Course::find($id);
        return view('teacher::courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $course = Course::find($id);
        $catagories = Catagory::publish()->get();
        return view('teacher::courses.edit', compact('course', 'catagories'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $req, $id)
    {
        $course = Course::find($id);
        $course->title = $req->input('title');
        $course->embed_code = $req->input('embed_code');
        if($req->file('image')){
            Storage::disk('public')->delete([$course->image_path]);
            $img = 'thumbnails/'.basename(Storage::putFile('public/thumbnails', $req->file('image')));
            $course->image_path = $img;
         }
        $course->catagory_id = $req->input('catagory_id');
        $course->slag = $req->input('slag');
        $course->meta_keys = $req->input('meta_keys');
        $course->meta_desc = $req->input('meta_desc');
        $course->details = (string) $req->input('details');
        $course->duration = $req->input('duration');
        $course->language = $req->input('language');
        $course->status = $req->input('status');
        $course->accessible = $req->input('accessible');
        $course->actual_price = $req->input('actual_price');
        $course->offer_price = $req->input('offer_price');
        $course->user_id = Auth::id();
        $course->canonical = $req->canonical;
        $course->mode = $req->mode;
        $course->session_time = $req->session_time;

        $out = $course->save();

        if($course->video){
            $course->video()->update(['videoable_type' => null, 'videoable_id' => null]);
        }
        if($req->vid){
            $video = Video::findOrFail($req->vid);
            $course->video()->save($video);
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        try {
            $course = Course::find($id);
            if($course->video){
                $course->video()->update(['videoable_type' => null, 'videoable_id' => null]);
            }
            foreach($course->topics as $topic){
                $topic->delete();
            }
            foreach($course->comments as $comment){
                $comment->delete();
            }
            // Image Delete
            Storage::disk('public')->delete([$course->image_path]);
            $out = $course->delete();

            return [ 'status' => 200,
                'message' => 'Course Deleted',
                'out' => $out
            ];
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function short(Request $req){
        $c = Course::find($req->id);
        $c->short = $req->short;
        $c->save();

        $out = [
            'status' => 200,
            'msg' => 'data saved'
        ];

        return $out;
    }
}
