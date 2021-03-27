<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Course;
use App\Models\InstaMojoPayment;
use App\Models\Money;
use App\Models\Topic;
use App\Models\UserAssesment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

class ApiController extends Controller
{
    private $online = 0;

    public function users(){
        $users = User::orderBy('id', 'DESC')->get();
        return $users;
    }

    public function users_details(){
        $users = User::orderBy('id', 'DESC')->get();

        if(Auth::user()->user_type == 'stuff'){
            $users = Auth::user()->manages;
        }
        return $users;
    }

    public function income(){
        return Money::all()->sum('withdraw_amt'); // User Consume It
    }

    public function expanse(){

        return 0;
    }

    public function online(){
        
        $users = User::all();
        foreach($users as $u){
            if($u->isOnline()){
                $this->online++;
            }
        }
        return $this->online;
    }

    public function activity(){
        return Activity::orderBy('id', 'DESC')->paginate(5);
    }

    public function chart(){
        $activity = new ActivityController();

        $acts = $activity->chartPrepaire();

        // dd($acts, gettype($acts->toArray()));

        $labels = array_map(function($data){
            // dd($data);
            return $data['date'];
        }, $acts->toArray());

        $new_users = array_map(function($data){
            // dd($data);
            return $data['new_user'];
        }, $acts->toArray());

        $page_views = array_map(function($data){
            // dd($data);
            return $data['views'];
        }, $acts->toArray());

        $active_users = array_map(function($data){
            // dd($data);
            return $data['active'];
        }, $acts->toArray());
        
        return [
            'labels' => $labels,
            'new_users' => $new_users,
            'active_users' => $active_users,
            'page_views' => $page_views
        ];
    }

    public function assesment(){
        $assesment = UserAssesment::orderBy('id', 'DESC')->get();
        $users = User::all();
        $topics = Topic::all();
        $courses = Course::all();

        return [$assesment, $users, $topics, $courses];
    }

    public function paymentInfo(){
        $paymentData = InstaMojoPayment::orderBy('id', 'DESC')->get();
        $users = User::all();
        $courses = Course::all();

        return [$paymentData, $users, $courses];
    }

    public static function routes(){
        Route::prefix('api')->group(function(){
            Route::get('income', 'ApiController@income');
            Route::get('expanse', 'ApiController@expanse');
            Route::get('online', 'ApiController@online');
            Route::get('users', 'ApiController@users');
            Route::get('chart', 'ApiController@chart');
            Route::get('activity', 'ApiController@activity');
            Route::get('assesment', 'ApiController@assesment');
            Route::get('paymentInfo', 'ApiController@paymentInfo');
            Route::get('udetails', 'ApiController@users_details');
        });
    }
}
