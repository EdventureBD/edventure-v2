<?php

namespace App\Models\Student\exam;

use App\Models\Admin\Batch;
use App\Models\Admin\Exam;
use App\Models\AppModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamResult extends AppModel
{
    use HasFactory, LogsActivity;
    protected static $logName = "Exam Result";

    protected $fillable = ['exam_id', 'batch_id', 'student_id', 'gain_marks', 'status'];

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

    public function student()
    {
        return $this->belongsTo(User::class);
    }

}
