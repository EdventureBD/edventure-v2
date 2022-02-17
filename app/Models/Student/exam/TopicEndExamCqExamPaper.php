<?php

namespace App\Models\Student\exam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Admin\TopicEndExamCreativeQuestion;

class TopicEndExamCqExamPaper extends Model
{
    use HasFactory;

    protected $table = "topic_end_exam_cq_exam_papers";

    protected static $logName = "Topic End Exam Cq Exam Paper";
    
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
        return $this->belongsTo(TopicEndExamCreativeQuestion::class);
    }

    public function getCqExamPaper($exam_id, $batch_id, $student_id)
    {
        return TopicEndExamCqExamPaper::where('exam_id', $exam_id)->where('batch_id', $batch_id)->where('student_id', $student_id)->first();
    }
}
