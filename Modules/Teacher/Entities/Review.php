<?php

namespace Modules\Teacher\Entities;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Teacher\Database\factories\ReviewFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return ReviewFactory::new();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }
}
