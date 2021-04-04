<?php

namespace App\models;

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

    public function videos(){
        return $this->morphMany(Video::class, 'videoable');
    }

    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
    }
}
