<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CQ extends Model
{
    use HasFactory, LogsActivity;
    protected static $logName = 'CQ';
    public function getDescriptionForEvent(string $eventName): string
    {
        return auth()->user()->name . " has {$eventName} CQ";
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $guarded = [];
}
