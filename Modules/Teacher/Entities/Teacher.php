<?php

namespace Modules\Teacher\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'username', 'profile_picture', 'keywords',
        'description', 'content', 'mobile', 'whatsapp', 'email',
        'website','type', 'user_id', 'premium_status', 'toc'
    ];

    protected static function newFactory()
    {
        return \Modules\Teacher\Database\factories\TeacherFactory::new();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function socials(){
        return $this->hasMany(Social::class);
    }
}
