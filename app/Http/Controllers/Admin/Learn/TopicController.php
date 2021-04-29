<?php

namespace App\Http\Controllers\Admin\Learn;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Topic;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    public function __construct(){
    }

    // Topics Section
    public function list(){
        $topics = Topic::orderBy('short')->get();
        return view('admin.learn.topics.list', ['title' => 'Topics List', 'topics' => $topics ]);
    }

    public function add(Request $req){
        $courses = Course::where('status', 'active')->get();
        $imp_course_id = $req->query('course');
        return view('admin.learn.topics.add', [
            'title' => 'Topic Add',
            'courses' => $courses,
            'course_id' => $imp_course_id
        ]);
    }

    public function create(Request $req){
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
            return redirect(url('admin/learn/course/view/'.$req->input('course_id')));
            // return back();
        }else{
            return redirect(route('admintopicadd'));
        }
    }

    public function edit(Topic $topic){
        $courses = Course::where('status', 'active')->get();
        return view('admin.learn.topics.edit', [
            'title' => 'Topic Edit',
            'courses' => $courses,
            'topic' => $topic,
            'course_id' =>$topic->course->id
        ]);
    }

    public function update(Request $req){
        $topic = Topic::find($req->tid);
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
            return redirect(url('admin/learn/course/view/'.$req->input('course_id')));
            // return back();
        }else{
            return redirect(route('admintopicedit'));
        }
    }

    public function view($id){
        $topic = Topic::find($id);
        return view('admin.learn.topics.view', ['title' => 'Topic View', 'topic' => $topic]);
    }

    public function delete(Topic $topic){
        if($topic->video){
            $topic->video()->update(['videoable_type' => null, 'videoable_id' => null]);
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
