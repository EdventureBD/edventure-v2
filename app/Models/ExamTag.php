<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamTag extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function examTopic()
    {
        return $this->belongsTo(ExamTopic::class);
    }

    public function modelMcqTagAnalysis()
    {
        return $this->hasMany(ModelMcqTagAnalysis::class);
    }

    public function usedInNumberOfQuestions($examId)
    {
        return $this->modelMcqTagAnalysis()->where('model_exam_id', $examId)->distinct('mcq_question_id')->count();
    }
}
