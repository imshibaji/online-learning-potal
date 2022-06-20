<?php

namespace Modules\Larnr\Http\Controllers;

use App\Models\Course;
use App\Models\Topic;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
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

        return view('larnr::courses.index', [
            'courses' => Course::where('status', 'active')->orderBy('short')->get()
        ]);
    }
    public function sitemap()
    {

        return view('larnr::courses.sitemap', [
            'courses' => Course::where('status', 'active')->get()
        ]);
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
    public function show($slug)
    {
        $course = Course::where('slag', $slug)->where('status', 'active')->first();

        if(!isset($course->title)){
            return redirect('/courses', 301);
        }
        $course->views++;
        $course->save();

        return view('larnr::courses.course', compact('course'));
    }

    public function course_preview(Request $req){
        $course = Course::where('id', $req->cid)->where('status', 'active')->first();
        $topics = $course->topics()->orderBy('short')->get();
        $topic = Topic::find($req->tid);

        // $utopics = Auth::user()->topicAssignments;
        // $assesments = Auth::user()->userAssesments()->where('topic_id', $req->tid)->get();
        return view('larnr::courses.course-preview', compact([ 'course', 'topics', 'topic' ]));
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
