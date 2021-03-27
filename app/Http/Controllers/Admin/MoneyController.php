<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Money;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class MoneyController extends Controller
{
    public function put(Request $req){
        $premoney = Money::where('user_id',$req->user_id)->get()->last();

        $money = new Money();
        $money->user_id = $req->user_id;
        $money->details = $req->details;

        if($req->type == 'credit'){
            $money->addition_amt = $req->amount;
            $money->withdraw_amt = 0;
            $money->balance_amt = ($premoney->balance_amt ?? 0) + $req->amount;

        } elseif($req->type == 'debit') {
            $money->addition_amt = 0;
            $money->withdraw_amt = $req->amount;
            $money->balance_amt = ($premoney->balance_amt ?? 0) - $req->amount;

        } elseif($req->type == 'balance') {
            $money->addition_amt = 0;
            $money->withdraw_amt = 0;
            $money->balance_amt = ($premoney->balance_amt ?? 0) + $req->amount;
        }
        
        $money->save();

        return back();
    }

    public function get(Request $req){
        $money = Money::where('user_id',$req->id)->get()->last();
        return $money;
    }

    public static function routes(){
        Route::prefix('money')->group(function(){
            Route::post('put', 'MoneyController@put')->name('adminmoneyput');
            Route::get('get', 'MoneyController@get')->name('adminmoneyget');
        });
    }
}
