<?php

namespace App\Models\Student\exam;

use App\Models\Admin\AptitudeTestMCQ;
use App\Models\User;
use App\Models\Admin\CQ;
use App\Models\Admin\MCQ;
use App\Models\Admin\Exam;
use App\Models\Admin\Batch;
use App\Models\Admin\Assignment;
use App\Models\AppModel;
use App\Utils\Edvanture;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailsResult extends AppModel
{
    use HasFactory;
    protected $fillable = ['exam_id', 'exam_type', 'question_id', 'batch_id', 'student_id', 'gain_marks', 'mcq_ans', 'status'];
    protected static $logName = "Details Result";

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName}";
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(MCQ::class);
    }

    public function atQuestion()
    {
        return $this->belongsTo(AptitudeTestMCQ::class, 'question_id', 'id');
    }

    public function cqQuestion()
    {
        return $this->belongsTo(CQ::class, 'question_id', 'id');
    }

    public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'question_id', 'id');
    }
}
