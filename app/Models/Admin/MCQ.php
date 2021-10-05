<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\QuestionContentTag;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MCQ extends Model
{
    use HasFactory, LogsActivity;
    protected static $logName = 'MCQ';
    public function getDescriptionForEvent(string $eventName): string
    {
        return auth()->user()->name . " has {$eventName} MCQ";
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $guarded  = [];

    public function questionContentTag()
    {
        return $this->hasOne(QuestionContentTag::class);
    }
}
