<?php

namespace App\Models\Admin;

use App\Models\Admin\Course;
use App\Models\Admin\CourseTopic;
use App\Models\Admin\CourseLecture;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContentTag extends Model
{
    use HasFactory, LogsActivity;
    protected static $logName = 'Content Tag';
    public function getDescriptionForEvent(string $eventName): string
    {
        // return auth()->user()->name . " has {$eventName} Content Tag";

        return "Admin has {$eventName} Content Tag";
    }

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function course()
    {
        return $this->hasMany(Course::class);
    }

    public function Lecture()
    {
        return $this->belongsTo(CourseLecture::class);
    }

    public function Topic()
    {
        return $this->belongsTo(CourseTopic::class);
    }

}
