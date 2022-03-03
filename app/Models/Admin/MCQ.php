<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\QuestionContentTag;
use App\Models\AppModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class MCQ extends AppModel
{
    use HasFactory;

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
