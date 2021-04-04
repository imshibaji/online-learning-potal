<?php

namespace App\Models;

use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use AhmedAliraqi\LaravelMediaUploader\Entities\Concerns\HasUploader;
use App\models\Course;
use App\models\Topic;

class Video extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia, HasUploader;

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
}
