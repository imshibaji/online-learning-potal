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

    public function topicComment(Request $req){

        if($req->cid != 0){
            $comment = Comment::find($req->cid);
        }else{
            $comment = new Comment();
        }
        $comment->message = $req->message;
        $comment->user_id = Auth::id();

        if($req->rid != 0){
            $comment->comment_id = $req->rid;
            $comment->save();
        }else if($req->cid != 0){
            $comment->save();
        }else{
            $topic = Topic::find($req->tid);
            $topic->comments()->save($comment);
        }

        // dd($topic->comments);

        session()->flash('status', 'Your comment posted Successfully.');
        return back();
    }

    public function commentDelete(Request $req){
        // dd($req->cid);
        $comment = Comment::find($req->cid);
        $comment->delete();

        session()->flash('status', 'Your comment deleted Successfully.');
        return [
            'status' => 200,
            'message'=> 'Comment is deleted..',
            'out' => $comment->id
        ];
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('user::create');
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
    public function show($id)
    {
        return view('user::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('user::edit');
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
