<?php

namespace App\Models\Admin;

use App\Models\Admin\CourseTopic;
use App\Models\Admin\BatchLecture;
use App\Models\Admin\CourseLecture;
use App\Models\Admin\CourseCategory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Admin\BatchStudentEnrollment;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory, LogsActivity;
    protected static $logName = 'Course';
    public function getDescriptionForEvent(string $eventName): string
    {
        // return auth()->user()->name . " has {$eventName} Course";
        return "Admin has {$eventName} Course";
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function courseCategory()
    {
        return $this->belongsTo(CourseCategory::class);
    }

    public function CourseTopic()
    {
        return $this->hasMany(CourseTopic::class);
    }

    public function CourseLecture()
    {
        return $this->hasMany(CourseLecture::class);
    }

    public function batchLecture()
    {
        return $this->hasMany(BatchLecture::class);
    }

    public function liveClass()
    {
        return $this->hasMany(LiveClass::class);
    }

    public function student()
    {
        return $this->hasMany(BatchStudentEnrollment::class, 'course_id');
    }
}
