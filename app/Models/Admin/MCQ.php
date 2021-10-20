<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\QuestionContentTag;
use App\Models\AppModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MCQ extends AppModel
{
    use HasFactory, LogsActivity;
    protected static $logName = 'MCQ';


    public function getDescriptionForEvent(string $eventName): string
    {
        return auth()->user()->name . " has {$eventName} MCQ";
    }

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
