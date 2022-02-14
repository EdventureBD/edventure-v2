<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $title
 * @property integer $exam_topic_id
 * @property integer $exam_category_id
 * @property integer $question_limit
 * @property integer $exam_type
 * @property integer $duration
 * @property boolean $negative_marking
 * @property integer $negative_marking_value
 * @property boolean $visibility
 * @property integer $per_question_marks
 * @property integer $total_exam_marks
 * @property string  $solution_pdf
 * @property string  $solution_video
 * @property integer $exam_price
 *
 */
class ModelExam extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
//    protected $appends = [
//        'question_count'
//    ];

//    public function getQuestionCountAttribute()
//    {
//        return $this->mcqQuestions()->count();
//    }

    public function category()
    {
        return $this->belongsTo(ExamCategory::class,'exam_category_id','id');
    }

    public function topic()
    {
        return $this->belongsTo(ExamTopic::class,'exam_topic_id','id');
    }

    public function mcqQuestions()
    {
        return $this->hasMany(McqQuestion::class,'model_exam_id','id');
    }

    public function mcqTotalResult()
    {
        return $this->hasMany(McqTotalResult::class,'model_exam_id','id');
    }

    public function paymentOfExams()
    {
        return $this->hasMany(PaymentOfExams::class,'model_exam_id','id');
    }

    public function mcqQuestionsCount()
    {
        return $this->mcqQuestions()->count();
    }
}
