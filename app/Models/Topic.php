<?php

namespace App\Models;

use App\Models\Video;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    public function course(){
        return $this->belongsTo('App\Models\Course');
    }

    public function questions(){
        return $this->hasMany('App\Models\Question');
    }
    public function assignments(){
        return $this->hasMany('App\Models\Assignment');
    }

    public function video(){
        return $this->morphOne(Video::class, 'videoable');
    }

    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
    }
}
