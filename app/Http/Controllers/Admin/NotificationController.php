<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class NotificationController extends Controller
{
    public function list(){
        $notifies = Notification::all();
        return view('admin.notify.list', compact('notifies'));
    }

    public function add(){
        return view('admin.notify.add');
    }

    public function create(Request $req){
        $notify = new Notification();

        $notify->user_id = $req->uid;
        $notify->title = $req->title;
        $notify->details = $req->details;
        $notify->sending_time = $req->sending_date.' '.$req->sending_time;
        $notify->expaire_at = $req->expaire_date.' '.$req->expaire_time;
        $notify->notify_type = $req->notify_type;
        $notify->premium_type = $req->premium_type;
        $notify->user_type = $req->user_type;
        $notify->save();

        session()->flash('status', 'Notification sended Successfull.');
        
        return back();
    }

    public function edit($id){
        $notify = Notification::find($id);
        return view('admin.notify.edit', compact('notify'));
    }

    public function update(Request $req){
        $notify = Notification::find($req->nid);

        $notify->user_id = $req->uid;
        $notify->title = $req->title;
        $notify->details = $req->details;
        $notify->sending_status = $req->sending_status;
        $notify->sending_time = $req->sending_date.' '.$req->sending_time;
        $notify->expaire_at = $req->expaire_date.' '.$req->expaire_time;
        $notify->notify_type = $req->notify_type;
        $notify->premium_type = $req->premium_type;
        $notify->user_type = $req->user_type;
        $notify->save();

        return back();
    }

    public function delete(){

    }

    public function view($id){
        return view('admin.notify.view', ['title'=> 'Notification View']);
    }

    public static function routes(){
        Route::get('admin/notify/list', 'Admin\NotificationController@list')->name('adminnotifylist');
        Route::get('admin/notify/add', 'Admin\NotificationController@add')->name('adminnotifyadd');
        Route::post('admin/notify/create', 'Admin\NotificationController@create')->name('adminnotifycreate');
        Route::get('admin/notify/edit/{id}', 'Admin\NotificationController@edit')->name('adminnotifyedit');
        Route::post('admin/notify/update', 'Admin\NotificationController@update')->name('adminnotifyupdate');
        Route::get('admin/notify/view/{id}', 'Admin\NotificationController@view')->name('adminnotifyview');
        Route::post('admin/notify/delete', 'Admin\NotificationController@delete')->name('adminnotifydelete');
    }

    private function short_code($msg, $user){
        $ua = $user;
        $tokens = ['fname', 'lname', 'email', 'mobile', 'dob', 'profession', 'orgname', 'whatsapp', 'address', 'city', 'pincode', 'state', 'country'];

        $message = $msg;
        foreach($tokens as $token){
            $message = str_ireplace('['.$token.']', $ua[$token], $message);
        }

        return $message;
    }
}
