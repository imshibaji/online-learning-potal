<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Learning extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'message',
        'total_learning_length',
        'skills',
        'tasks',
        'learning_points',
        'design_points',
        'developing_points',
        'debugging_points',
        'reports_chart',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function chart(){
        return $this->hasMany('App\Models\UserChart');
    }
}
