<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelMcqQuestionAnalysis extends Model
{
    use HasFactory;

    protected $guarded =  ['id'];
    protected $table = 'model_mcq_question_analysis';
}
