<?php

namespace App\Models\Admin;

use App\Models\User;
use App\Models\Admin\LiveClass;
use App\Models\Admin\BatchLecture;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Admin\BatchStudentEnrollment;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Batch extends Model
{
    use HasFactory, LogsActivity;
    protected static $logName = 'Batch';
    public function getDescriptionForEvent(string $eventName): string
    {
        return auth()->user()->name . " has {$eventName} Batch";
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function batchLecture()
    {
        $this->hasMany(BatchLecture::class);
    }

    public function studentEnrollment()
    {
        return $this->hasMany(BatchStudentEnrollment::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function liveClass()
    {
        $this->hasMany(LiveClass::class);
    }
}
