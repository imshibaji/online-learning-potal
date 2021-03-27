<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseAssignment extends Model
{
    protected $fillable = [
        'user_id',
        'course_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function course(){
        return $this->belongsTo('App\Models\Course');
    }
    public function topicAssignments(){
        return $this->hasMany('App\Models\TopicAssignment');
    }
}
