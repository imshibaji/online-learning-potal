<?php

namespace Modules\Teacher\Http\Controllers;

use App\Models\Course;
use App\Models\Topic;
use App\Models\Video;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $topics = Topic::where('user_id', Auth::id())->orderBy('short')->get();
        return view('teacher::topics.index', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $req)
    {
        $courses = Course::where('status', 'active')->get();
        $imp_course_id = $req->query('course');
        return view('teacher::topics.create', compact('courses', 'imp_course_id'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {
        $topic = new Topic();
        $topic->title = $req->input('title');
        $topic->embed_code = $req->input('embed_code');
        $topic->details = $req->input('details');
        $topic->duration = json_encode($req->input('duration'));
        $topic->status = $req->input('status');
        $topic->premium_status = $req->input('premium_status');
        $topic->user_id = Auth::id();
        $topic->course_id = $req->input('course_id');

        $result = $topic->save();

        $topic->short = $topic->id;
        $topic->save();

        if($req->vid){
            $video = Video::find($req->vid);
            $topic->video()->save($video);
        }

        if($result){
            return redirect(route('teachercourses.show', $req->input('course_id')));
            // return back();
        }else{
            return redirect(route('teachertopics.create'));
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $topic = Topic::find($id);
        return view('teacher::topics.show', compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $courses = Course::where('status', 'active')->get();
        $topic = Topic::find($id);

        return view('teacher::topics.edit',[
            'courses' => $courses,
            'topic' => $topic,
            'course_id' => $topic->course->id
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $req, $id)
    {
        $topic = Topic::find($id);
        $topic->title = $req->input('title');
        $topic->embed_code = $req->input('embed_code');
        $topic->details = $req->input('details');
        $topic->duration = json_encode($req->input('duration'));
        $topic->status = $req->input('status');
        $topic->premium_status = $req->input('premium_status');
        $topic->user_id = Auth::id();
        $topic->course_id = $req->input('course_id');

        $result = $topic->save();

        if($topic->video){
            $topic->video()->update(['videoable_type' => null, 'videoable_id' => null]);
        }
        if($req->vid){
            $video = Video::find($req->vid);
            $topic->video()->save($video);
        }


        if($result){
            return redirect(route('teachercourses.show', $req->input('course_id')));
            // return back();
        }else{
            return redirect(route('teachertopics.edit'));
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $topic = Topic::find($id);
        if($topic->video){
            $topic->video()->update(['videoable_type' => null, 'videoable_id' => null]);
        }
        $out = $topic->delete();

        return [ 'status' => 200,
            'message' => 'Topic Deleted',
            'out' => $out
        ];
    }
}
