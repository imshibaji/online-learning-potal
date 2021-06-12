<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catagory extends Model
{
    public function subCategories(){
        return $this->hasMany(Catagory::class, 'catagory_id');
    }
    public function parentCategory(){
        return $this->belongsTo(Catagory::class, 'catagory_id');
    }
    public function scopePublish(){
        return $this->where('status', 'active');
    }
    public function courses(){
        return $this->hasMany('App\Models\Course');
    }
}
