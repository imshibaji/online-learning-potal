<?php

namespace App\Http\Controllers\Admin\Learn;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Question;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    // Questions Section
    public function list(){
        $questions = Question::orderBy('short')->get();
        return view('admin.learn.questions.list', ['title' => 'Questions List', 'questions' => $questions ]);
    }

    public function topic_by_course($id){
        return Course::find($id)->topics;
    }

    public function add(){
        $courses = Course::where('status', 'active')->get();
        return view('admin.learn.questions.add', ['title' => 'Question Add', 'courses' => $courses]);
    }

    public function create(Request $req){
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
            // return redirect(route('adminquestionlist'));
            return back();
        else
            return redirect(route('adminquestionadd'));
    }

    public function edit($id){
        $courses = Course::where('status', 'active')->get();
        $question = Question::find($id);
        return view('admin.learn.questions.edit', ['title' => 'Question Edit', 'courses' => $courses, 'question' => $question]);
    }

    public function update(Request $req){
        $q = Question::find($req->qid);
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
            // return redirect(route('adminquestionlist'));
            return back();
        else
            return redirect(route('adminquestionendit'));
    }

    public function view($id){
        $question = Question::find($id);
        return view('admin.learn.questions.view', ['title' => 'Question View', 'question' => $question]);
    }

    public function delete(Question $question){
        $out = $question->delete();

        return [ 'status' => 200,
            'message' => 'Question Deleted',
            'out' => $out
        ];
    }

    public function short(Request $req){
        $q = Question::find($req->id);
        $q->short = $req->short;
        $q->save();

        $out = [
            'status' => 200,
            'msg' => 'data saved'
        ];

        return $out;
    }

}
