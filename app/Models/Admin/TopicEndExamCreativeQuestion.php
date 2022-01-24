<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Admin\Exam;
use App\Models\Admin\TopicEndExamCQ;
use App\Models\Student\exam\TopicEndExamCqExamPaper;

class TopicEndExamCreativeQuestion extends Model
{
    use HasFactory;

    protected $table = "topic_end_exam_creative_questions";

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function question()
    {
        return $this->hasMany(TopicEndExamCQ::class, 'creative_question_id');
    }

    public function exam_papers()
    {
        return $this->hasOne(TopicEndExamCqExamPaper::class, 'creative_question_id');
    }
}
