<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseCategory extends Model
{
    use HasFactory, LogsActivity;

    protected static $logName = 'Course Category';
    public function getDescriptionForEvent(string $eventName): string
    {
        return auth()->user()->name . " has {$eventName} Course Category";
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function course()
    {
        return $this->hasMany(Course::class);
    }
}
