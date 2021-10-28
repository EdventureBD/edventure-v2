<?php

namespace App\Models\Admin;

use App\Models\Admin\Batch;
use App\Models\Admin\Course;
use App\Models\Admin\CourseTopic;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BatchLecture extends Model
{
    use HasFactory, LogsActivity;
    protected static $logName = 'Batch Lecture';
    public function getDescriptionForEvent(string $eventName): string
    {
        return auth()->user()->name . " has {$eventName} Batch Lecture";
    }

    public function course()
    {
        $this->belongsTo(Course::class);
    }

    public function topic()
    {
        $this->belongsTo(CourseTopic::class);
    }

    public function batch()
    {
        $this->belongsTo(Batch::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'teacher_id');
    }

    public function courseTopic()
    {
        return $this->belongsTo(CourseTopic::class, 'topic_id');
    }
}
