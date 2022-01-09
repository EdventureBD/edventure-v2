<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Exam;
use App\Models\Admin\TopicEndExamCQ;

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
}
