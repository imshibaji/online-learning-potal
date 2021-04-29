<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname',
        'lname',
        'mobile',
        'email',
        'password',
        'whatsapp',
        'address',
        'city',
        'pincode',
        'state',
        'country',
        'user_type',
        'active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function generateToken()
    {
        $key = Str::random(60);
        $this->api_token = hash('sha256', $key);
        $this->save();

        return $key;
    }

    public function fullname(){
        return $this->fname. ' '.$this->lname;
    }

    public function scopeIsActive($q){
        return $q->where('active', 1);
    }

    public function scopeIsAdmin($query){
        return $query->where('user_type', 'admin');
    }

    public function scopeIsStuff($query){
        return $query->where('user_type', 'stuff');
    }

    public function scopeIsUser($query){
        return $query->where('user_type', 'user');
    }

    public function reffered(){
        return $this->belongsTo('App\Models\User', 'reffer_by_user_id');
    }

    public function reffers(){
        return $this->hasMany('App\Models\User', 'reffer_by_user_id');
    }

    public function manager(){
        return $this->belongsTo('App\Models\User', 'manage_by_user_id');
    }

    public function manages(){
        return $this->hasMany('App\Models\User', 'manage_by_user_id');
    }

    public function assignments(){
        return $this->hasMany('App\Models\Assignment');
    }

    public function courseAssignments(){
        return $this->hasMany('App\Models\CourseAssignment');
    }

    public function topicAssignments(){
        return $this->hasMany('App\Models\TopicAssignment');
    }

    public function userAssesments(){
        return $this->hasMany('App\Models\UserAssesment');
    }

    public function courses(){
        return $this->hasManyThrough('App\Models\Assignment', 'App\Models\Course');
    }

    public function learning(){
        return $this->hasOne('App\Models\Learning');
    }

    public function gems(){
        return $this->hasMany('App\Models\Gem');
    }

    public function money(){
        return $this->hasMany('App\Models\Money');
    }

    public function userChart(){
        return $this->hasMany('App\Models\UserChart');
    }

    public function instaMojoPayments(){
        return $this->hasMany('App\Models\InstaMojoPayment');
    }

    public function activities(){
        return $this->hasMany('App\Models\Activity');
    }

    public function isOnline(){
        return Cache::has('user-is-online-' . $this->id);
    }

    // Creator Part
    public function courseCreator(){
        return $this->hasMany('App\Models\Course');
    }
    public function videosCreator(){
        return $this->hasMany(Video::class);
    }

    public function courseManager(){
        return $this->hasMany('App\Models\Course', 'manager_user_id');
    }
}
