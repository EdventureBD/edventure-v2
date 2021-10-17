<?php

namespace App\Models\Student\exam;

use App\Models\Admin\CreativeQuestion;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CqExamPaper extends Model
{
    use HasFactory, LogsActivity;
    protected static $logName = "Cq Exam Paper";
    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName}";
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class);
    }

    public function creativeQuestion()
    {
        return $this->belongsTo(CreativeQuestion::class);
    }
}
