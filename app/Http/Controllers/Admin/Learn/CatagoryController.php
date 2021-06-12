<?php

namespace App\Http\Controllers\Admin\Learn;

use App\Http\Controllers\Controller;
use App\Models\Catagory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CatagoryController extends Controller
{
    public function list(){
        $catagories = Catagory::orderBy('short')->get();
        return view('admin.learn.catagory.list', ['title' => 'Catagory List', 'catagories' => $catagories]);
    }

    public function add(){
        $catagories = Catagory::orderBy('short')->get();
        return view('admin.learn.catagory.add', [
            'title' => 'Catagory Add',
            'catagories' => $catagories
        ]);
    }

    public function create(Request $req){
        $catagory = new Catagory();
        $catagory->title = $req->input('title');
        $catagory->details = $req->input('details');
        $catagory->status = $req->input('status');
        $catagory->catagory_id = $req->input('catagory_id');
        $out = $catagory->save();

        return redirect(route('admincatagorylist'));
    }

    public function edit($id){
        $catagory = Catagory::find($id);
        $catagories = Catagory::orderBy('short')->get();
        return view('admin.learn.catagory.edit', [
            'title' => 'Catagory Edit',
            'catagory' => $catagory,
            'catagories' => $catagories
        ]);
    }

    public function update(Request $req){

        $catagory = Catagory::find($req->id);
        $catagory->title = $req->input('title');
        $catagory->details = $req->input('details');
        $catagory->status = $req->input('status');
        $catagory->catagory_id = $req->input('catagory_id');

        $out = $catagory->save();
        return redirect(route('admincatagorylist'));
    }

    public function view($id){
        $catagory = Catagory::find($id);
        return view('admin.learn.catagory.view', ['title' => 'Catagory View', 'catagory' => $catagory]);
    }

    public function delete($id){
        $catagory = Catagory::find($id);
        $out = $catagory->delete();

        return [ 'status' => 200,
            'message' => 'Catagory Deleted',
            'out' => $out
        ];
    }

    public function short(Request $req){
        $c = Catagory::find($req->id);
        $c->short = $req->short;
        $c->save();

        $out = [
            'status' => 200,
            'msg' => 'data saved'
        ];

        return $out;
    }

    public static function routes(){
        Route::prefix('catagory')->group(function(){
            Route::get('list', 'Learn\CatagoryController@list')->name('admincatagorylist');
            Route::get('add', 'Learn\CatagoryController@add')->name('admincatagoryadd');
            Route::post('create', 'Learn\CatagoryController@create')->name('admincatagorycreate');
            Route::get('edit/{id}', 'Learn\CatagoryController@edit')->name('admincatagoryedit');
            Route::post('update', 'Learn\CatagoryController@update')->name('admincatagoryupdate');
            Route::get('view/{id}', 'Learn\CatagoryController@view')->name('admincatagoryview');
            Route::post('delete/{id}', 'Learn\CatagoryController@delete')->name('admincatagorydelete');
            Route::post('short', 'Learn\CatagoryController@short')->name('admincatagoryshort');
        });
    }
}
