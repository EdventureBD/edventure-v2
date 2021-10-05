<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CreativeQuestion extends Model
{
    use HasFactory, LogsActivity;
    protected static $logName = 'Course Topic';
    public function getDescriptionForEvent(string $eventName): string
    {
        // return auth()->user()->name . " has {$eventName} Course Topic";
        return "Admin has {$eventName} Course Category";
    }

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
