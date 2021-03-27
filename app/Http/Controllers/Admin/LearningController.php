<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Learning;
use App\Models\UserChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class LearningController extends Controller
{
    public function create_update(Request $req){
        $learning = Learning::updateOrCreate(
            ['user_id' => $req->user_id, 'id' => $req->lid],
            [
                'user_id' => $req->user_id,
                'title' => $req->title,
                'message' => $req->message,
                'total_learning_length' => $req->total_learning_length,
                'skills' => $req->skills,
                'tasks' => $req->tasks,
                'learning_points' => $req->learning_points,
                'design_points' => $req->design_points,
                'developing_points' => $req->developing_points,
                'debugging_points' => $req->debugging_points,
                // 'reports_chart' => $this->put_learning($req)
            ]
        );
        $learning->save();
        $this->put_learning($req);
        return back();
    }

    public function put_learning(Request $req)
    {
        $chart = new UserChart();
        $chart->task_name = $req->reports_chart['task_name'];
        $chart->design = $req->reports_chart['design_point'];
        $chart->develop = $req->reports_chart['develop_points'];
        $chart->debug = $req->reports_chart['debug_points'];

        
        $chart->user_id = $req->user_id;
        $chart->learning_id = $req->lid;

        $chart->save();

        return $chart;
    }

    public function get_learning(Request $req){
        $chartData = UserChart::where('learining_id', $req->lid)->get();


        $chartData = $chartData->toArray();

        $tasks = array_map(function($data){
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

        // return [$tasks, $designs, $develops, $debugs];
        return $chartData;
    }

    public static function routes(){
        Route::prefix('learning')->group(function(){
            Route::get('/put', 'LearningController@put_learning')->name('putlearningchart');
            Route::get('/get', 'LearningController@get_learning')->name('getlearningchart');
        });
        
    }
}
