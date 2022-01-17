<?php

namespace App\Models\Student\exam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Admin\popQuizCreativeQuestion;

class PopQuizCqExamPaper extends Model
{
    use HasFactory;

    protected $table = "pop_quiz_cq_exam_papers";

    protected static $logName = "Pop Quiz Cq Exam Paper";
    
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
        return $this->belongsTo(PopQuizCreativeQuestion::class, 'creative_question_id', 'id');
    }

    public function getCqExamPaper($exam_id, $batch_id, $student_id)
    {
        return PopQuizCqExamPaper::where('exam_id', $exam_id)->where('batch_id', $batch_id)->where('student_id', $student_id)->first();
    }
}
