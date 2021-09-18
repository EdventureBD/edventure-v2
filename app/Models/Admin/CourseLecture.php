<?php

namespace App\Models\Admin;

use App\Models\Admin\Course;
use App\Models\Admin\CourseTopic;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseLecture extends Model
{
    use HasFactory, LogsActivity;
    protected static $logName = 'Course Lecture';
    public function getDescriptionForEvent(string $eventName): string
    {
        return auth()->user()->name . " has {$eventName} Course Lecture";
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function Course()
    {
        return $this->belongsTo(Course::class);
    }

    public function Topic()
    {
        return $this->belongsTo(CourseTopic::class);
    }
}
