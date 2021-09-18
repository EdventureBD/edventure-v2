<?php

namespace App\Models\Admin;
use App\Models\Admin\Batch;
use App\Models\Admin\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class LiveClass extends Model
{
    use HasFactory, LogsActivity;
    protected static $logName = 'Live Class';
    public function getDescriptionForEvent(string $eventName): string
    {
        return auth()->user()->name . " has {$eventName} Live Class";
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
