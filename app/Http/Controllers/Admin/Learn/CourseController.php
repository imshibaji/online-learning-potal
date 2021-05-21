<?php

namespace App\Http\Controllers\Admin\Learn;

use App\Http\Controllers\Controller;
use App\Models\Catagory;
use App\Models\Course;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function list(){
        // $courses = Course::orderBy('short')->get();
        $courses = Course::orderBy('short')->paginate(5);
        return view('admin.learn.course.list', ['title' => 'Course List', 'courses' => $courses]);
    }

    public function rearrange(){
        $courses = Course::orderBy('short')->get();
        return view('admin.learn.course.rearrange', ['title' => 'Course Rearrange', 'courses' => $courses]);
    }

    public function add(){
        $catagories = Catagory::where('status', 'active')->get();
        return view('admin.learn.course.add', ['title' => 'Course Add', 'catagories' => $catagories]);
    }

    public function create(Request $req){
        $course = new Course();
        $course->title = $req->input('title');
        $course->embed_code = $req->input('embed_code');
        $course->catagory_id = $req->input('catagory_id');
        $course->slag = $req->input('slag');
        $course->meta_keys = $req->input('meta_keys');
        $course->meta_desc = $req->input('meta_desc');
        $course->details = (string) $req->input('details');
        $course->duration = $req->input('duration');
        $course->status = $req->input('status');
        $course->accessible = $req->input('accessible');
        $course->actual_price = $req->input('actual_price');
        $course->offer_price = $req->input('offer_price');
        $course->user_id = Auth::id();
        $course->canonical = $req->canonical;

        $out = $course->save();

        if($req->vid){
            $video = Video::findOrFail($req->vid);
            $course->video()->save($video);
        }


        // $course = Course::create($req->all());

        return redirect(route('admincourselist'));
    }

    public function edit($id){
        $course = Course::find($id);
        $catagories = Catagory::where('status', 'active')->get();
        return view('admin.learn.course.edit', ['title' => 'Course Edit', 'course' => $course, 'catagories' => $catagories]);
    }

    public function update(Request $req){
        $course = Course::find($req->id);
        $course->title = $req->input('title');
        $course->embed_code = $req->input('embed_code');
        $course->catagory_id = $req->input('catagory_id');
        $course->slag = $req->input('slag');
        $course->meta_keys = $req->input('meta_keys');
        $course->meta_desc = $req->input('meta_desc');
        $course->details = (string) $req->input('details');
        $course->duration = $req->input('duration');
        $course->status = $req->input('status');
        $course->accessible = $req->input('accessible');
        $course->actual_price = $req->input('actual_price');
        $course->offer_price = $req->input('offer_price');
        $course->user_id = Auth::id();
        $course->canonical = $req->canonical;

        $out = $course->save();

        if($course->video){
            $course->video()->update(['videoable_type' => null, 'videoable_id' => null]);
        }
        if($req->vid){
            $video = Video::findOrFail($req->vid);
            $course->video()->save($video);
        }
        return redirect(route('admincourselist'));
    }

    public function view($id){
        $course = Course::find($id);
        return view('admin.learn.course.view', ['title' => 'Course View', 'course' => $course]);
    }

    public function delete($id){
        $course = Course::find($id);
        if($course->video){
            $course->video()->update(['videoable_type' => null, 'videoable_id' => null]);
        }
        $out = $course->delete();

        return [ 'status' => 200,
            'message' => 'Course Deleted',
            'out' => $out
        ];
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
