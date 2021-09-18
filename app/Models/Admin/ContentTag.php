<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContentTag extends Model
{
    use HasFactory, LogsActivity;
    protected static $logName = 'Content Tag';
    public function getDescriptionForEvent(string $eventName): string
    {
        return auth()->user()->name . " has {$eventName} Content Tag";
    }

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
