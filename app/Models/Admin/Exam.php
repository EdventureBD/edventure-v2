<?php

namespace App\Models\Admin;

use App\Models\Admin\Course;
use App\Models\Admin\BatchExam;
use App\Models\Admin\CourseTopic;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exam extends Model
{
    use HasFactory, LogsActivity;
    protected static $logName = 'Exam';
    public function getDescriptionForEvent(string $eventName): string
    {
        return auth()->user()->name . " has {$eventName} Exam";
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function batchExam()
    {
        return $this->hasMany(BatchExam::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function topic()
    {
        return $this->belongsTo(CourseTopic::class);
    }
}
