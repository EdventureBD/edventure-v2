<?php

namespace App\Models\Admin;

use App\Models\Admin\Exam;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BatchExam extends Model
{
    use HasFactory, LogsActivity;
    protected static $logName = 'Batch Exam';
    public function getDescriptionForEvent(string $eventName): string
    {
        return auth()->user()->name . " has {$eventName} Batch Exam";
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }
}
