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

    public function category()
    {
        return $this->belongsTo(ExamCategory::class,'exam_category_id','id');
    }

    public function topic()
    {
        return $this->belongsTo(ExamTopic::class,'exam_topic_id','id');
    }
}
