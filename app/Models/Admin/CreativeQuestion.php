<?php

namespace App\Models\Admin;

use App\Models\Admin\Exam;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CreativeQuestion extends Model
{
    use HasFactory, LogsActivity;
    protected static $logName = 'Creative Question';
    public function getDescriptionForEvent(string $eventName): string
    {
        return auth()->user()->name . " has {$eventName} Creative Question";
    }

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
