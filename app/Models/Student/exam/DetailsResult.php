<?php

namespace App\Models\Student\exam;

use App\Models\Admin\AptitudeTestMCQ;
use App\Models\User;
use App\Models\Admin\CQ;
use App\Models\Admin\MCQ;
use App\Models\Admin\Exam;
use App\Models\Admin\Batch;
use App\Models\Admin\Assignment;
use App\Models\AppModel;
use App\Utils\Edvanture;
use Illuminate\Database\Eloquent\Model;

use App\Models\Admin\PopQuizMCQ;
use App\Models\Admin\TopicEndExamMCQ;
use App\Models\Admin\PopQuizCQ;
use App\Models\Admin\TopicEndExamCQ;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailsResult extends AppModel
{
    use HasFactory;
    protected $fillable = ['exam_id', 'exam_type', 'question_id', 'batch_id', 'student_id', 'gain_marks', 'mcq_ans', 'status'];
    protected static $logName = "Details Result";

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(MCQ::class);
    }

    public function atQuestion()
    {
        return $this->belongsTo(AptitudeTestMCQ::class, 'question_id', 'id');
    }

    public function popQuizMCQ(){
        return $this->belongsTo(PopQuizMCQ::class, 'question_id', 'id');
    }

    public function topicEndExamMCQ(){
        return $this->belongsTo(TopicEndExamMCQ::class, 'question_id', 'id');
    }

    public function cqQuestion()
    {
        return $this->belongsTo(CQ::class, 'question_id', 'id');
    }

    public function popQuizCqQuestion()
    {
        return $this->belongsTo(PopQuizCQ::class, 'question_id', 'id');
    }

    public function topicEndExamCqQuestion()
    {
        return $this->belongsTo(TopicEndExamCQ::class, 'question_id', 'id');
    }

    public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'question_id', 'id');
    }
}
