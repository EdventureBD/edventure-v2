<?php

namespace App\Models\Admin;

use App\Utils\Edvanture;
use App\Models\Admin\Exam;
use Illuminate\Support\Facades\Auth;
use App\Models\Student\exam\ExamResult;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student\exam\CqExamPaper;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BatchExam extends Model
{
    use HasFactory;

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

    public function getBatchExams($batch_id, $exam_type)
    {
        $allExams = $this->whereHas('exam', function($query) use ($exam_type) {
            return $query->where('exam_type', $exam_type);
        }
        )->where('batch_id', $batch_id)->where('status', '1')->with(['exam', 'cqExamPaper', 'examResult'])->get();

        // $allExams = $this->with(['exam', 'cqExamPaper', 'examResult'])->where('batch_id', $batch_id)->where('status', '1')->get();

        // dd($allExams);
        $specialExams = [];
        $exams = [];
        foreach ($allExams as $exam) {
            // dd($exam);
            if ($exam->exam->special) {
                $specialExams[] = $exam;
            } else {
                $exams[] = $exam;
            }

            foreach ($specialExams as $spExam) {
                $spExam->canAttemp = true;
                // if exam type is MCQ and there are $spExam results present in DB
                if ($spExam->exam->exam_type == Edvanture::MCQ && $spExam->examResult->count() > 0) {
                    foreach ($spExam->examResult as $exResult) {
                        if ($exResult->student_id == Auth::user()->id && $exResult->status == 1) {
                            $spExam->canAttemp = false;
                        }
                    }
                } else if ($spExam->exam->exam_type == Edvanture::CQ && $spExam->cqExamPaper->count() > 0) {
                    foreach ($spExam->cqExamPaper as $cqResult) {
                        if ($cqResult->student_id == Auth::user()->id) {
                            $spExam->canAttemp = false;
                        }
                    }
                }
            }

            foreach ($exams as $exam) {
                $exam->canAttemp = true;
                if ($exam->exam->exam_type == Edvanture::MCQ && $exam->examResult->count() > 0) {
                    foreach ($exam->examResult as $eexResult) {
                        if ($eexResult->student_id == Auth::user()->id) {
                            $exam->canAttemp = false;
                        }
                    }
                } else if ($exam->exam->exam_type == Edvanture::CQ && $exam->cqExamPaper->count() > 0) {
                    foreach ($exam->cqExamPaper as $ecqResult) {
                        if ($ecqResult->student_id == Auth::user()->id) {
                            $exam->canAttemp = false;
                        }
                    }
                }
            }

        // $special_exams_sorted = collect();
        // $exams_sorted = collect();

        // foreach($specialExams as $exam){
        //     $special_exams_sorted = $special_exams_sorted->push($exam->exam);
        // }

        // foreach($exams as $exam){
        //     $exams_sorted = $exams_sorted->push($exam->exam);
        // }

        // $special_exams_sorted = $special_exams_sorted->groupBy('exam_type');
        // $exams_sorted = $exams_sorted->groupBy('exam_type');

        // dd($specialExams, $exams, $allExams);

        return [$exams, $specialExams];
    }

    // public function getBatchExams($batch_id)
    // {
    //     $allExams = $this->with(['exam', 'cqExamPaper', 'examResult'])->where('batch_id', $batch_id)->where('status', '1')->get();

    //     foreach ($allExams as $exam) {
    //         if ($exam->exam->special) {
    //             $specialExams[] = $exam;
    //         } else {
    //             $exams[] = $exam;
    //         }
    //     }

    //     foreach ($specialExams as $spExam) {
    //         $spExam->canAttemp = true;
    //         // if exam type is MCQ and there are $spExam results present in DB
    //         if ($spExam->exam->exam_type == Edvanture::MCQ && $spExam->examResult->count() > 0) {
    //             foreach ($spExam->examResult as $exResult) {
    //                 if ($exResult->student_id == Auth::user()->id && $exResult->status == 1) {
    //                     $spExam->canAttemp = false;
    //                 }
    //             }
    //         } else if ($spExam->exam->exam_type == Edvanture::CQ && $spExam->cqExamPaper->count() > 0) {
    //             foreach ($spExam->cqExamPaper as $cqResult) {
    //                 if ($cqResult->student_id == Auth::user()->id) {
    //                     $spExam->canAttemp = false;
    //                 }
    //             }
    //         }
    //     }
    //     foreach ($exams as $exam) {
    //         $exam->canAttemp = true;
    //         if ($exam->exam->exam_type == Edvanture::MCQ && $exam->examResult->count() > 0) {
    //             foreach ($exam->examResult as $eexResult) {
    //                 if ($eexResult->student_id == Auth::user()->id) {
    //                     $exam->canAttemp = false;
    //                 }
    //             }
    //         } else if ($exam->exam->exam_type == Edvanture::CQ && $exam->cqExamPaper->count() > 0) {
    //             foreach ($exam->cqExamPaper as $ecqResult) {
    //                 if ($ecqResult->student_id == Auth::user()->id) {
    //                     $exam->canAttemp = false;
    //                 }
    //             }
    //         }
    //     }

    //     // dd($exams);
    //     return [$exams, $specialExams];
    // }
    }
}