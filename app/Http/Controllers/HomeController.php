<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Learning;
use App\Models\Money;
use App\Models\Topic;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Instamojo\Instamojo;

class HomeController extends Controller
{
    private $util;
    public function __construct()
    {
        $this->util = (object) include_once(resource_path('utils/util.php'));
    }

    public function index(){
        $uid = Auth::id();
        if($uid){
            return redirect('user');
        }

        $states = $this->getStates();
        $countries = $this->getCountry();
        $cities = $this->getCities();

        return view('fronts.main',
        [
            'states' => $states,
            'countries' => $countries,
            'cities' => $cities
        ]);
    }

    public function signin(Request $req){
        request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $req->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('user');
        }
        session()->flash('status', 'Oppes! You have entered invalid credentials');
        return redirect("login");
    }

    public function register_page(){
        $uid = Auth::id();
        if($uid){
            return redirect('user');
        }

        $states = $this->getStates();
        $countries = $this->getCountry();
        $cities = $this->getCities();

        return view('fronts.signup',
        [
            'states' => $states,
            'countries' => $countries,
            'cities' => $cities
        ]);
    }

    public function signup(Request $req){
        $ref = 1;
        if($req->ref){
            $ref = base64_decode($req->ref);
        }

        $user = User::create([
            'fname' => $req->fname,
            'lname' => $req->lname,
            // 'name' => $req->fname.' '.$req->lname,
            'mobile' => $req->mobile,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'whatsapp' => $req->whatsapp,
            'address' => $req->address,
            'city' => $req->city,
            'pincode' => $req->pincode,
            'state' => $req->state,
            'country' => $req->country,
            'user_type' => 'user',
            'reffer_by_user_id' => $ref,
            'manage_by_user_id' => 1,
            'active' => true
        ]);
        event(new Registered($user));

        $id = $user->id;
        if($id>0){
            // session()->flash('status', 'You are succesefully register with us. login now.');
            // return redirect('login');
            request()->validate([
                'email' => 'required',
                'password' => 'required',
            ]);

            $credentials = $req->only('email', 'password');
            if (Auth::attempt($credentials)) {
                // Authentication passed...
                return redirect()->intended('user');
            }
        }
        session()->flash('status', 'You got registeration problem. Contact with us.');
        return redirect('login');
    }

    public function about()
    {
        return view('fronts.about');
    }

    public function plans(){
        return view('fronts.plans');
    }

    public function data(Request $req)
    {

        // return Auth::user();
        return base64_encode($req->ref);
    }

    public function refer_code()
    {
        $user = Auth::user();
        return base64_encode($user->id);
    }

    public function getCities(){
        return $this->util->cities;
    }

    public function getStates(){
        return $this->util->states;
    }

    public function getCountry(){
        return $this->util->countries;
    }

    public function adminActivityInfo(){
        $user = Auth::user();
        return $user;
    }

    public function profile(Request $req){
        if($req->uid){
            $user = User::find($req->uid);
            $user->email = $user->email;
            $user->fname = $req->fname;
            $user->lname = $req->lname;
            $user->mobile = $req->mobile;
            $user->dob = $req->dob;
            $user->profession = $req->profession;
            $user->orgname = $req->orgname;
            $user->email = $req->email;
            $user->whatsapp = $req->whatsapp;
            $user->address = $req->address;
            $user->city = $req->city;
            $user->pincode = $req->pincode;
            $user->state = $req->state;
            $user->country = $req->country;
            $user->save();

            session()->flash('status', 'Profile Updated.');
        }else{
            session()->flash('status', 'Profile not Updated.');
        }
        return back();
    }

    public function changePassword(Request $req){

        if($req->input('new-password') == $req->input('confirm-password')){
            $user = User::where('email', $req->email)
            ->first();

            if(Hash::check($req->input('current-password'), Auth::user()->password)){
                $user->password =  Hash::make($req->input('new-password'));
                $user->save();

                session()->flash('status', 'Password Changed.');
            }else{
                session()->flash('status', 'Email and Password Not Match with Our Records.');
            }
        }else{
            session()->flash('status', 'New Password and Confirm Password Not Matched.');
        }
        return back();
    }

    public function userActivityInfo(){
        $learn = Auth::user()->learning;
        $chartData = Auth::user()->userChart;
        $money = Auth::user()->money()->get()->last();
        $gems = Auth::user()->gems()->get()->last();

        $userPay = Money::where('user_id',Auth::id())->get();

        $chartData = $chartData->toArray();

        $task_name = array_map(function($data){
            return $data['task_name'];
        }, $chartData);

        $designs = array_map(function($data){
            return $data['design'];
        }, $chartData);

        $develops = array_map(function($data){
            return $data['develop'];
        }, $chartData);

        $debugs = array_map(function($data){
            return $data['debug'];
        }, $chartData);


        return [
            // User Activity Information
            'totalAmt' => $userPay->sum('addition_amt'),
            'dueAmt' => $money->balance_amt ?? 0,
            'learning' => 'Total '.$learn->learning_points ?? 0,
            'earning' => $gems->balance_gems ?? 0,
            // Course Name and Details Section
            'title' => $learn->title,
            'message' => $learn->message,
            'skills' => $learn->skills,
            'tasks' => $learn->tasks,
            'learn' => $learn->learning_points,
            // Chart Section
            'length' => $learn->total_learning_length,
            'taskName' => $task_name,
            'design' => $designs,
            'develop' => $develops,
            'debug' => $debugs,
            // Report Section
            'total_design' => $learn->design_points,
            'total_develop' => $learn->developing_points,
            'total_debug' => $learn->debugging_points,
        ];
    }

    public function AuthRouteAPI(Request $request){
        return $request->user();
    }

    public function course($slag){
        $course = Course::where('slag', $slag)->where('status', 'active')->first();
        $title = $course->title;
        return view('fronts.course', compact('course', 'title'));
    }
    public function courses(){
        $courses = Course::where('status', 'active')->orderBy('short')->get();
        return view('fronts.courses', ['courses' => $courses]);
    }
    public function course_preview(Request $req){
        $course = Course::where('id', $req->cid)->where('status', 'active')->first();
        $topics = $course->topics()->orderBy('short')->get();
        $topic = Topic::find($req->tid);

        // $utopics = Auth::user()->topicAssignments;
        // $assesments = Auth::user()->userAssesments()->where('topic_id', $req->tid)->get();
        return view('fronts.course-preview', compact([ 'course', 'topics', 'topic' ]));
    }

    public function jobs() {
        return view('fronts.jobs');
    }
    public function jobDetails () {
        return view('fronts.job-details');
    }

    public function candidates() {
        return view('fronts.candidates');
    }
    public function candDetails() {
        return view('fronts.cand-details');
    }
    public function add(){
        return view('admin.business-add');
    }

    public function getUsers() {
        $users = User::all();
        return $users;
    }

    public function apiGen($id){
        $user = User::find($id);
        return $user->generateToken();
    }
    public function error() {
        return view('errors.404');
    }
}
