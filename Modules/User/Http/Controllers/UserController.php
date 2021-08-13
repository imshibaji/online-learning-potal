<?php

namespace Modules\User\Http\Controllers;

use App\Models\Comment;
use App\Models\Course;
use App\Models\CourseAssignment;
use App\Models\Topic;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
    public function index(){
        Artisan::call('inspire');
        $inspaire = Artisan::output();
        $allcourses = Course::where('status', 'active')->orderBy('short')->get() ?? [];
        $mycourses = CourseAssignment::where('user_id', Auth::id())->get() ?? [];
        // $videos = Video::inRandomOrder()->limit(4)->get();
        // $videos = Video::all();

        $courses = $allcourses;

        foreach($allcourses as $key => $allc){
            foreach($mycourses as $myc){
                if($allc->id == $myc->course->id){
                    unset($courses[$key]);
                }
            }
        }

        return view('user::home', compact(['inspaire', 'courses']));
    }

    /**
     * User Course List
     */
    public function my_courses(Request $req){
        $courses = Auth::user()->courseAssignments;
        $assesments = Auth::user()->userAssesments()->where('topic_id', $req->tid)->get();
        $topics = Auth::user()->topicAssignments;
        $topic = Topic::find($req->tid);


        return view('user::courses', [
            'title' => 'My Courses Area',
            'courses' => $courses,
            'topics' => $topics,
            'topic' => $topic,
            'assesments' => $assesments
        ]);
        // return $learnings;
    }

    /**
     * User Learning Section
     */
    public function course_details(Request $req){
        try{
            $course = Course::find($req->id);
            $sections = $course->sections()->orderBy('short')->get();
            $topics = $course->topics()->orderBy('short')->get();
            $topic = Topic::find($req->tid);
            $comments = isset($req->tid)? $topic->comments()->where('user_id', Auth::id())->get() : [];

            // $topic = $course->topics()->orderBy('short')->paginate(1);
            // dd($topic);

            $utopics = Auth::user()->topicAssignments;
            $assesments = Auth::user()->userAssesments()->where('topic_id', $req->tid)->get();
            return view('user::course-details', compact('course','sections', 'topics', 'topic', 'assesments', 'comments'));
        }catch(Exception $e){
            return view('errors.404');
        }
    }

    /**
     *  Video Time Tracker
     */
    public function videoTracker(Request $req){
        try {
            $ct = $req->ct;
            $rt = $req->rt;
            $dt = $req->dt;
            $cid = $req->cid;
            $tid = $req->tid;
            $stat = $req->status;
            $user = Auth::id();

            return [
                'current_time' =>  $ct,
                'remain_time' =>  $rt,
                'duration' => $dt,
                'course' => $cid,
                'topic' => $tid,
                'status' => $stat,
                'user' => $user
            ];
        } catch (Exception $e) {
            return $e;
        }
    }
}
