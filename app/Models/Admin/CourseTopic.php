<?php

namespace App\Models\Admin;

use App\Models\Admin\LiveClass;
use App\Models\Admin\BatchLecture;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseTopic extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function Course()
    {
        return $this->belongsTo(Course::class);
    }

    public function CourseLecture()
    {
        return $this->hasMany(CourseLecture::class, 'topic_id', 'id');
    }

    public function batchLecture()
    {
        $this->hasMany(BatchLecture::class);
    }

    public function liveClass()
    {
        $this->hasMany(LiveClass::class);
    }
}
