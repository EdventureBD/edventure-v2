<?php

namespace App\Models\Student\exam;

use App\Models\Admin\CreativeQuestion;
use Illuminate\Database\Eloquent\Model;

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

    public function getCqExamPaper($exam_id, $batch_id, $student_id)
    {
        return CqExamPaper::where('exam_id', $exam_id)->where('batch_id', $batch_id)->where('student_id', $student_id)->first();
    }
}
