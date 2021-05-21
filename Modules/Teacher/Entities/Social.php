<?php

namespace Modules\Teacher\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class social extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Teacher\Database\factories\SocialFactory::new();
    }

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
}
