<?php

namespace Modules\Teacher\Http\Controllers;

use App\Models\Course;
use App\Models\Section;
use App\Models\Topic;
use App\Models\Video;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
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
    public function index(Request $req)
    {
        // $topics = Topic::where('user_id', Auth::id())->orderBy('short')->get();
        $courses = Course::where('user_id', Auth::id())->orderBy('short')->get();
        $course = Course::find($req->cid);
        // dd($course);
        return view('teacher::topics.index', compact('courses', 'course'));
    }

    /**
     * Get All Sections Data
     * @return section[]
     */
    public function getSections(Request $req){
        try {
            $course = Course::find($req->cid);
            $sections = $course->sections()->orderBy('short')->get();
            return $sections;
        } catch (Exception $ex) {
            return $ex;
        }

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $req)
    {
        $courses = Course::where('user_id', Auth::id())->orderBy('short')->get();
        $sections = Section::where('status', 'active')->orderBy('short')->get();
        $course_id = $req->query('cid');
        $section_id = $req->query('sid');
        return view('teacher::topics.create', compact('courses','sections', 'course_id','section_id'));
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
        $topic->section_id = $req->input('section_id');

        $result = $topic->save();

        $topic->short = $topic->id;
        $topic->save();

        if($req->vid){
            $video = Video::find($req->vid);
            $topic->video()->save($video);
        }
        return redirect(route('teachertopics.edit', $topic->id));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $topic = Topic::find($id);
        // return $topic;
        return view('teacher::topics.show', compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $courses = Course::where('user_id', Auth::id())->orderBy('short')->get();
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
        $topic->section_id = $req->input('section_id');

        $result = $topic->save();

        if($topic->video){
            $topic->video()->update(['videoable_type' => null, 'videoable_id' => null]);
        }
        if($req->vid){
            $video = Video::find($req->vid);
            $topic->video()->save($video);
        }


        // if($result){
        //     return redirect(route('teachercourses.show', $req->input('course_id')));
        //     // return back();
        // }else{
        //     return redirect(route('teachertopics.edit'));
        // }
        return back();
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
        if($topic->comments){
            foreach($topic->comments as $comment){
                $comment->delete();
            }
        }
        $out = $topic->delete();

        return [ 'status' => 200,
            'message' => 'Topic Deleted',
            'out' => $out
        ];
    }

    public function short(Request $req){
        $c = Topic::find($req->id);
        $c->short = $req->short;
        $c->save();

        $out = [
            'status' => 200,
            'msg' => 'data saved'
        ];

        return $out;
    }
}
