<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\Topic;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function scopePublish(){
        return $this->where('status', 'free')->where('type', 'publish');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function courses(){
        return $this->morphedByMany(Course::class, 'videoable');
    }

    public function topics(){
        return $this->morphedByMany(Topic::class, 'videoable');
    }

    public function videoable(){
        return $this->morphTo();
    }

    public function linked(){
        return $this->belongsTo($this->videoable_type, 'videoable_id');
    }

    public function category(){
        return $this->belongsTo(Catagory::class, 'catagory_id');
    }

    public function tags(){
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
