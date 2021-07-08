<?php

namespace Modules\Teacher\Http\Controllers;

use App\Models\Course;
use App\Models\Question;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
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
        $questions = Question::where('user_id', Auth::id())->orderBy('short')->get();
        return view('teacher::questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $req)
    {
        $courses = Course::where('status', 'active')->get();
        $course_id = $req->query('c');
        $topic_id = $req->query('t');
        return view('teacher::create', compact('courses', 'course_id', 'topic_id'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {
        $q = new Question();
        $q->topic_id = $req->input('topic_id');
        $q->question = $req->input('question');
        $q->qtype = $req->input('qtype');
        $q->opt = json_encode($req->input('opt'));
        $q->ans = json_encode($req->input('ans'));
        $q->answer = $req->input('answer');
        $q->design_points = $req->input('design_points');
        $q->development_points = $req->input('development_points');
        $q->debugging_points = $req->input('debugging_points');
        $q->duration = json_encode($req->input('duration'));
        $q->status = $req->input('status');
        $q->user_id = Auth::id();

        $out = $q->saveOrFail();

        if($out)
            return redirect(route('teachertopics.show', $req->topic_id));
            // return back();
        else
            return redirect(route('teacherquestions.create'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $question = Question::find($id);
        return view('teacher::show', [
            'question' => $question,
            'topic_id' => $question->topic->id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $courses = Course::where('status', 'active')->get();
        $question = Question::find($id);
        return view('teacher::questions.edit', [
            'courses' => $courses,
            'question' => $question,
            'course_id' => $question->topic->course->id,
            'topic_id' => $question->topic->id,
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
        $q = Question::find($id);
        $q->topic_id = $req->input('topic_id');
        $q->question = $req->input('question');
        $q->qtype = $req->input('qtype');
        $q->opt = json_encode($req->input('opt'));
        $q->ans = json_encode($req->input('ans'));
        $q->answer = $req->input('answer');
        $q->design_points = $req->input('design_points');
        $q->development_points = $req->input('development_points');
        $q->debugging_points = $req->input('debugging_points');
        $q->duration = json_encode($req->input('duration'));
        $q->status = $req->input('status');
        $q->user_id = Auth::id();

        $out = $q->saveOrFail();

        if($out)
            return redirect(route('teachertopics.show'));
            // return back();
        else
            return redirect(route('teacherquestions.edit'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $question = Question::find($id);
        $out = $question->delete();

        return [ 'status' => 200,
            'message' => 'Question Deleted',
            'out' => $out
        ];
    }
}
