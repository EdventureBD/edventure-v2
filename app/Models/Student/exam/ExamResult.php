<?php

namespace App\Models\Student\exam;

use App\Models\Admin\Batch;
use App\Models\Admin\Exam;
use App\Models\AppModel;
use App\Models\User;
use App\Utils\Edvanture;
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

    public function getExamResultsForDashboard($user_id, $batch_id)
    {
        $results = $this->with('exam')->where('batch_id', $batch_id)->where('student_id', $user_id)->get();
        $mcq_labels = ['Exam'];
        $cq_labels = ['Exam'];
        $mcq = [0];
        $cq = [0];
        $n =1;
        foreach ($results as $result) {

            if ($result->exam->exam_type == Edvanture::MCQ) {
                array_push($mcq_labels, 'Exam-'.$n);
                $mpercentage = round(($result->gain_marks * 100) / $result->exam->marks);
                array_push($mcq, $mpercentage);
            } else if ($result->exam->exam_type == Edvanture::CQ) {
                array_push($cq_labels, 'Exam-'.$n);
                $percentage = round(($result->gain_marks * 100) / $result->exam->marks);
                array_push($cq, $percentage);
            }
            $n++;
        }
        $labels = count($mcq_labels) > count($cq_labels) ? $mcq_labels : $cq_labels;
        return ['labels' => $labels, 'mcq' => $mcq, 'cq' => $cq];
    }

    public function getExamResult($exam_id, $batch_id, $user_id)
    {
        return ExamResult::where('exam_id', $exam_id)
            ->where('batch_id', $batch_id)
            ->where('student_id', $user_id)
            ->first();
    }
}
