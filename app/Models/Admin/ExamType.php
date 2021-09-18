<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ExamType extends Model
{
    use HasFactory, LogsActivity;
    protected static $logName = 'Exam Type';
    public function getDescriptionForEvent(string $eventName): string
    {
        return auth()->user()->name . " has {$eventName} Exam Type";
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
