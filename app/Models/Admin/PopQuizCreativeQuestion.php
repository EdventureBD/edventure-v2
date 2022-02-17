<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Admin\Exam;
use App\Models\Admin\PopQuizCQ;
use App\Models\Student\exam\DetailsResult;
use App\Models\Student\exam\PopQuizCqExamPaper;

class PopQuizCreativeQuestion extends Model
{
    use HasFactory;

    protected $table = "pop_quiz_creative_questions";

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
        return $this->hasMany(PopQuizCQ::class, 'creative_question_id');
    }

    public function exam_papers()
    {
        return $this->hasOne(PopQuizCqExamPaper::class, 'creative_question_id');
    }
}
