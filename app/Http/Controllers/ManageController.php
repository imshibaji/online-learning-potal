<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ManageController extends Controller
{
    public function __construct()
    {
        
    }
    public function index(Request $req){
        return User::find($req->uid)->isActive();
    }
    public function make($name){
        $out = Artisan::call("make:controller", ['name' => $name]);
        return $out;
    }
    public function migrate(){
        $out = Artisan::call("migrate", []);
        return $out;
    }

    public function mail(){
        $out = Artisan::call("schedule:run", []);
        return $out;
    }
}
