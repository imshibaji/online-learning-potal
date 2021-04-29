<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
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

    public function category(){
        return $this->belongsTo(Catagory::class, 'catagory_id');
    }
}