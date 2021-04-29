<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityChart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    public function create(Request $req){
        $act = new Activity();
        $act->client_ip = $req->client_ip;
        $act->city = $req->city;
        $act->region = $req->region;
        $act->country = $req->country;
        $act->timezone = $req->timezone;
        $act->page_name = $req->page_name;
        $act->page_path = $req->page_path;
        $act->user_agent = $req->user_agent;
        $act->referer = $req->referer;
        $act->user_id = Auth::id() ?? null;
        $act->save();

       $this->chartDataCreate($req);

    //    dd($req);

        return $req;
    }

    public function delete()
    {
        $count = Activity::count();
        $deleteUs = Activity::latest()->take($count)->skip(20)->get();
        foreach($deleteUs as $deleteMe){
            Activity::where('id',$deleteMe->id)->delete();
        }
        return $count;
    }

    public function chartDataCreate(Request $req){
        $actChart = ActivityChart::where('client_ip', $req->client_ip)
        ->where('date', date('Y-m-d', strtotime(now()) ))
        ->where('user_id', Auth::id())->first();

        if(!isset($actChart)){
            $act = new ActivityChart();
            $act->client_ip = $req->client_ip;
            $act->page_views = 1;
            $act->user_id = Auth::id() ?? null;
            $act->date = now();
            $act->save();
        }
        else {
            $actChart->page_views += 1;
            $actChart->user_id = Auth::id() ?? $actChart->user_id;
            $actChart->save();
        }
        return $req;
    }

    public function chartPrepaire()
    {
        $from = (new Carbon)->subDays(29)->startOfDay()->toDateString();
        $to = (new Carbon)->now()->endOfDay()->toDateString();

        $dates = ActivityChart::groupBy('date')
        ->whereBetween('date',[$from, $to])
        ->selectRaw('count(*) as total_users, date')
        ->get();

        foreach($dates as $d){
            $new_user = count(ActivityChart::where('user_id', null)
            ->where('date', $d->date )
            ->get());

            $d->new_user = $new_user;

            // Active Users
            $active_user = ActivityChart::select('user_id', DB::raw('count(*) as visits'))
            ->where('date', $d->date )
            ->groupBy('user_id')
            ->get();

            $active = $active_user->sum('visits') - $new_user;

            $d->active = $active;
            //

            $views = ActivityChart::where('date', $d->date )
            ->get()->sum('page_views');

            $d->views = $views;

            $d->active_users = $active_user;
        }

        return  $dates;
    }

    public function chartDataDelete()
    {
        $count = ActivityChart::count();
        $last_7days_count = count(ActivityChart::where('created_at','>=',Carbon::now()->subdays(7))->get());

        $deleteUs = Activity::latest()->take($count)->skip($last_7days_count)->get();
        foreach($deleteUs as $deleteMe){
            ActivityChart::where('id',$deleteMe->id)->delete();
        }
        return $count;
    }
}
