<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BatchStudentEnrollment extends Model
{
    use HasFactory, LogsActivity;
    protected static $logName = 'Batch Student Enrollment';
    public function getDescriptionForEvent(string $eventName): string
    {
        return auth()->user()->name . " has {$eventName} Batch Student Enrollment";
    }

    protected $guarded = [];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(User::class);
    }
}
