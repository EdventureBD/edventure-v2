<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\QuestionContentTag;

class TopicEndExamMCQ extends Model
{
    use HasFactory;

    protected $table = "topic_end_exam_mcqs";

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $fillable  = ['question', 'slug', 'image', 'field1', 'field2', 'field3', 'field4', 'answer', 'explanation', 'exam_id', 'number_of_attempt', 'gain_marks', 'success_rate'];

    public function questionContentTag()
    {
        return $this->hasOne(QuestionContentTag::class);
    }
}
