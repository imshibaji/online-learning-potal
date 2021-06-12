<?php

namespace App\Models;

use App\Models\Comment;
use App\Models\Video;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    // protected $guarded = ['_token'];
    // protected $fillable = [
    //     'title',
    //     'slag',
    //     'status',
    //     'premium_status',
    //     'user_id'
    // ];

    public function scopePublish(){
        return $this->where('status', 'active');
    }
    public function createdBy(){
        return $this->belongsTo('App\User');
    }

    public function managedBy(){
        return $this->belongsTo('App\User', 'manager_user_id');
    }

    public function topics(){
        return $this->hasMany('App\Models\Topic');
    }

    public function video(){
        return $this->morphOne(Video::class, 'videoable');
    }

    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
    }
    public function tags(){
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
