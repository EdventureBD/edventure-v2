<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\QuestionContentTag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\AppModel;

class AptitudeTestMCQ extends AppModel
{
    use HasFactory;

    protected $table = "aptitude_test_mcqs";

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
