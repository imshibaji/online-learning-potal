<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class GemsController extends Controller
{
    public function put(Request $req){
        $pregem = Gem::where('user_id',$req->user_id)->get()->last();

        $gem = new Gem();
        $gem->user_id = $req->user_id;
        $gem->details = $req->details;

        if($req->type == 'credit'){
            $gem->addition_gems = $req->gems;
            $gem->withdraw_gems = 0;
            $gem->balance_gems = ($pregem->balance_gems ?? 0) + $req->gems;

        } elseif($req->type == 'debit') {
            $gem->addition_gems = 0;
            $gem->withdraw_gems = $req->gems;
            $gem->balance_gems = ($pregem->balance_gems ?? 0) - $req->gems;

        } elseif($req->type == 'balance') {
            $gem->addition_gems = 0;
            $gem->withdraw_gems = 0;
            $gem->balance_gems = ($pregem->balance_gems ?? 0) + $req->amount;
        }
        
        $gem->save();

        return back();
    }

    public function get(Request $req){
        $gem = Gem::where('user_id',$req->id)->get()->last();
        return $gem;
    }

    public static function routes(){
        Route::prefix('gems')->group(function(){
            Route::post('put', 'GemsController@put')->name('admingemsput');
            Route::get('get', 'GemsController@get')->name('admingemsget');
        });
    }
}
