<?php

namespace Modules\Teacher\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Modules\Teacher\Entities\Teacher;

class TeacherController extends Controller
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

        $article = Article::where('user_id', Auth::id())->publish()->orderBy('id', 'desc')->first();
        $comments = Comment::where('user_id', Auth::id())->where('commentable_id','!=', null)->limit(4)->get();
        $totalViews = Auth::user()->articles()->sum('views') + Auth::user()->courses()->sum('views');
        return view('teacher::index', compact('article', 'comments', 'totalViews'));
    }

    public function page($page){
        if(file_exists(module_path('teacher').'/Resources/views/'.$page.'/index.blade.php')){
            return view('teacher::'.$page.'.index');
        }else{
            return view('teacher::'.$page);
        }
    }


    public function create()
    {
        $teacher = Teacher::where('user_id', Auth::id())->first();
        // dd($teacher);
        if($teacher){
            return redirect()->route('teacher.home');
        }
        return view('teacher::create');
    }

    public function profile()
    {
        $teacher = Auth::user()->teacher;
        return view('teacher::profile', compact('teacher'));
    }

    public function store(Request $req)
    {
        if($req->accepted){
            $teacher = new Teacher();
            $teacher->title = $req->title;
            $teacher->username = $req->username;

            // dd($req->file('profile_picture'));

            if($req->file('profile_picture')){
                $img = 'teachers/' . basename(Storage::putFile('public/teachers', $req->file('profile_picture')));
                $teacher->profile_picture = $img;
            }
            $teacher->keywords = $req->keywords;
            $teacher->description = $req->description;
            $teacher->content = $req->content;
            $teacher->mobile = $req->mobile;
            $teacher->whatsapp = $req->whatsapp;
            $teacher->email = $req->email;
            $teacher->website = $req->website;
            $teacher->type = $req->type;
            $teacher->user_id = Auth::id();
            $teacher->premium_status = $req->premium_status;
            $teacher->toc = ($req->toc == 1)? true : false;
            $teacher->save();

            session()->flash('status', 'Profile is updated');

            return redirect()->route('teacher.profile');
        }else{
            session()->flash('status', 'Please accept Terms and Conditions');
        }
        return back();
    }

    public function show($id)
    {
        $teacher = Teacher::find($id);
        return view('teacher::show', compact('teacher'));
    }

    public function edit($id)
    {
        $teacher = Teacher::find($id);
        return view('teacher::profile', compact('teacher'));
    }

    public function update(Request $req, $id)
    {
        if($req->accepted){
            $teacher = Teacher::find($id);
            $teacher->title = $req->title;
            $teacher->username = $req->username;

            if($req->file('profile_picture')){
                Storage::disk('public')->delete([$teacher->image_path]);
                $img = 'teachers/' . basename(Storage::putFile('public/teachers', $req->file('profile_picture')));
                $teacher->profile_picture = $img;
            }
            $teacher->keywords = $req->keywords;
            $teacher->description = $req->description;
            $teacher->content = $req->content;
            $teacher->mobile = $req->mobile;
            $teacher->whatsapp = $req->whatsapp;
            $teacher->email = $req->email;
            $teacher->website = $req->website;
            $teacher->type = $req->type;
            $teacher->user_id = Auth::id();
            $teacher->premium_status = $req->premium_status;
            $teacher->toc = ($req->toc == 1)? true : false;
            $teacher->save();

            session()->flash('status', 'Profile is updated');
        }else{
            session()->flash('status', 'Please accept Terms and Conditions');
        }
        return back();
    }

    public function destroy($id)
    {
        //
    }
}
