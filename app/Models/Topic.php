<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Plank\Mediable\Mediable;

class Topic extends Model
{
    use Mediable;

    public function course(){
        return $this->belongsTo('App\Models\Course');
    }

    public function questions(){
        return $this->hasMany('App\Models\Question');
    }
    public function assignments(){
        return $this->hasMany('App\Models\Assignment');
    }
}
