<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Money;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(){
        $balance = Money::where('user_id', Auth::id())->get()->last()->balance_amt ?? 0;
        $totalPaid = Money::where('user_id', Auth::id())->get()->sum('addition_amt');
        // $money = Money::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();
        $money = Money::where('user_id', Auth::id())->orderBy('id', 'DESC')->paginate(12);

        $fields = [
            'details', 
            'created_at', 
            [
                'key' =>'addition_amt',
                'label' => 'Credit'
            ],
            [
                'key' => 'withdraw_amt',
                'label' => 'Debit'
            ]
        ];
        $items = $money;
       return view('users.fund', compact('fields', 'items', 'balance', 'totalPaid'));
    }

    public function gems()
    {
        return view('users.leads');
    }
}
