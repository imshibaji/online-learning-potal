<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function course(){
        return $this->belongsTo('App\Models\Course');
    }
    public function topic(){
        return $this->belongsTo('App\Models\Topic');
    }
    public function reply(){
        return $this->belongsTo('App\Models\Comment', 'comment_id');
    }
    public function replies(){
        return $this->hasMany('App\Models\Comment', 'comment_id');
    }
    public function commentable(){
        return $this->morphTo();
    }
}
