<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user(){
        return $this->belongsTo('App\Models\User');
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
