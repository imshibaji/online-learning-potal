<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityChart extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
}
