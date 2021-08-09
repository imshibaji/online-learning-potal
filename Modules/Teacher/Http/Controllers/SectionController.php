<?php

namespace Modules\Teacher\Http\Controllers;

use App\Models\Course;
use App\Models\Section;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
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
        return view('teacher::sections.index', compact('courses', 'course'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $req)
    {
        $courses = Course::where('user_id', Auth::id())->get();
        $course_id = $req->query('cid');
        return view('teacher::sections.create', compact('courses', 'course_id'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {
        $section = new Section();
        $section->title = $req->title;
        $section->description = $req->description;
        $section->course_id = $req->course_id;
        $section->status = $req->status;
        $section->save();


        return redirect(route('teachersections.edit', $section->id));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $section = Section::find($id);

        return view('teacher::sections.show', compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $section = Section::find($id);
        $courses = Course::where('user_id', Auth::id())->get();
        $course_id = $section->course->id;

        return view('teacher::sections.edit', compact('section', 'courses', 'course_id'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $req, $id)
    {
        $section = Section::find($id);
        $section->title = $req->title;
        $section->description = $req->description;
        $section->course_id = $req->course_id;
        $section->status = $req->status;
        $section->save();

        return redirect(route('teachersections.edit', $section->id));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $section = Section::find($id);
        $out = $section->delete();

        return [ 'status' => 200,
            'message' => 'Section Deleted',
            'out' => $out
        ];
    }

    public function short(Request $req){
        $c = Section::find($req->id);
        $c->short = $req->short;
        $c->save();

        $out = [
            'status' => 200,
            'msg' => 'data saved'
        ];

        return $out;
    }
}
