<?php

namespace App\Models\Admin;

use App\Models\Admin\Exam;
use App\Models\Student\exam\CqExamPaper;
use App\Models\Student\exam\ExamResult;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BatchExam extends Model
{
    use HasFactory, LogsActivity;
    protected static $logName = 'Batch Exam';
    public function getDescriptionForEvent(string $eventName): string
    {
        return auth()->user()->name . " has {$eventName} Batch Exam";
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function cqExamPaper()
    {
        return $this->hasMany(CqExamPaper::class, 'exam_id', 'exam_id');
    }

    public function examResult()
    {
        return $this->hasMany(ExamResult::class, 'exam_id', 'exam_id');
    }

    public function getBatchExams($batch_id)
    {
        $allExams = $this->with('exam', 'cqExamPaper', 'examResult')->where('batch_id', $batch_id)->where('status', '1')->get();
        // dd($allExams);
        $specialExams = [];
        $exams = [];
        foreach ($allExams as $exam) {
            if ($exam->exam->special) {
                $specialExams[] = $exam;
            } else {
                $exams[] = $exam;
            }
        }
        // dd($specialExams);
        return [$exams, $specialExams];
    }
}
