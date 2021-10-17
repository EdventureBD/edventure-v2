<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin\Exam;
use App\Models\Admin\Batch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\CreativeQuestion;
use App\Models\Student\exam\ExamPaper;
use App\Models\Student\exam\ExamResult;
use App\Models\Admin\QuestionContentTag;
use App\Models\Admin\StudentExamAttempt;
use App\Models\Student\exam\CqExamPaper;
use App\Models\Student\exam\DetailsResult;
use App\Models\Student\exam\QuestionContentTagAnalysis;

class SubmissionController extends Controller
{
    public function submission(Batch $batch, Exam $exam, $exam_type)
    {
        if ($exam->exam_type == 'MCQ') {
            $exam_results = ExamResult::where('batch_id', $batch->id)->where('exam_id', $exam->id)->get();
            return view('admin.pages.batch_exam.submission.exam_result', compact('exam_results'));
        } else {
            $student_exam_attempts = StudentExamAttempt::where('exam_id', $exam->id)->get();
            $exam_results = ExamResult::where('batch_id', $batch->id)->where('exam_id', $exam->id)->get();
            return view('admin.pages.batch_exam.submission.exam_paper_submission_student', compact('student_exam_attempts', 'batch', 'exam_results'));
        }
    }

    public function seeDetails(Batch $batch, Exam $exam, $exam_type, User $student)
    {
        if ($exam->exam_type == 'MCQ') {
            $details_result = DetailsResult::join('m_c_q_s', 'm_c_q_s.id', 'details_results.question_id')
                ->where('details_results.batch_id', $batch->id)
                ->where('details_results.exam_id', $exam->id)
                ->where('details_results.student_id', $student->id)
                ->select('details_results.*', 'm_c_q_s.question as mcq')
                ->get();
            return view('admin.pages.batch_exam.submission.details_exam_result', compact('details_result', 'batch', 'exam', 'exam_type', 'student'));
        } else if ($exam->exam_type == 'Assignment') {
            $exam_papers = ExamPaper::join('assignments', 'assignments.id', 'exam_papers.question_id')
                ->where('exam_papers.exam_id', $exam->id)
                ->where('exam_papers.batch_id', $batch->id)
                ->where('exam_papers.student_id', $student->id)
                ->select('exam_papers.*', 'assignments.*')
                ->get();
            $exam_results = DetailsResult::join('assignments', 'assignments.id', 'details_results.question_id')
                ->where('details_results.exam_id', $exam->id)
                ->where('details_results.batch_id', $batch->id)
                ->where('details_results.student_id', $student->id)
                ->select('assignments.*', 'details_results.*')
                ->get();
            return view('admin.pages.batch_exam.submission.exam_paper_review_and_result', compact('exam_papers', 'batch', 'exam', 'exam_type', 'student', 'exam_results'));
        } else if ($exam->exam_type == 'CQ') {
            // $exam_papers = ExamPaper::join('c_q_s', 'c_q_s.id', 'exam_papers.question_id')
            //     ->where('exam_papers.exam_id', $exam->id)
            //     ->where('exam_papers.batch_id', $batch->id)
            //     ->where('exam_papers.student_id', $student->id)
            //     ->select('exam_papers.*', 'c_q_s.*')
            //     ->get();
            $exam_papers = CqExamPaper::where('exam_id', $exam->id)
                ->where('batch_id', $batch->id)
                ->where('student_id', $student->id)
                ->get();
            // dd($exam_papers);
            $exam_results = DetailsResult::join('c_q_s', 'c_q_s.id', 'details_results.question_id')
                ->where('details_results.exam_id', $exam->id)
                ->where('details_results.batch_id', $batch->id)
                ->where('details_results.student_id', $student->id)
                ->select('c_q_s.*', 'details_results.*')
                ->get();
            // dd($exam_papers, $exam_results);
            return view('admin.pages.batch_exam.submission.exam_paper_review_and_result', compact('exam_papers', 'batch', 'exam', 'exam_type', 'student', 'exam_results'));
        }
    }

    public function giveMarks(Request $request, Batch $batch, Exam $exam, $exam_type, User $student)
    {
        if ($exam_type == 'CQ') {
            // dd($request, sizeof($request->q));
            $total = 0;
            for ($i = 0; $i < sizeof($request->q); $i++) {
                $value = $request->q[$i];
                $gain_marks = $request->m[$value];
                $details_result = new DetailsResult();
                $details_result->exam_id = $exam->id;
                $details_result->exam_type = $exam_type;
                $details_result->question_id = $request->q[$i];
                $details_result->batch_id = $batch->id;
                $details_result->student_id = $student->id;
                $details_result->gain_marks = $gain_marks;
                $details_result->status = 1;
                $total = $total + $details_result->gain_marks;
                $details_result->save();

                $questionContentTags = QuestionContentTag::where('question_id', $request->q[$i])->get();
                if ($questionContentTags->count() > 0) {
                    foreach ($questionContentTags as $questionContentTag) {
                        $questionContentTagAnalysis = new QuestionContentTagAnalysis();
                        $questionContentTagAnalysis->content_tag_id = $questionContentTag->content_tag_id;
                        $questionContentTagAnalysis->student_id = $student->id;
                        $questionContentTagAnalysis->exam_type = 'CQ';
                        $questionContentTagAnalysis->question_id = $request->q[$i];
                        $questionContentTagAnalysis->number_of_attempt = 1;
                        $questionContentTagAnalysis->gain_marks = $gain_marks;
                        $questionContentTagAnalysis->status = 1;
                        $questionContentTagAnalysis->save();
                    }
                }
            }
            $exam_result = new ExamResult();
            $exam_result->exam_id = $exam->id;
            $exam_result->batch_id = $batch->id;
            $exam_result->student_id = $student->id;
            $exam_result->gain_marks = $total;
            $exam_result->status = 1;
            $save = $exam_result->save();
            if ($save) {
                return redirect()->back();
            }
            // return $this->giveMarksTo($request, $batch, $exam, $exam_type, $student);
        } else if ($exam_type == 'Assignment') {
            return $this->giveMarksTo($request, $batch, $exam, $exam_type, $student);
        }
    }

    private function giveMarksTo($request, $batch, $exam, $exam_type, $student)
    {
        // dd($request);
        $total = 0;
        for ($i = 1; $i <= sizeof($request->m); $i++) {
            $details_result = new DetailsResult();
            $details_result->exam_id = $exam->id;
            $details_result->exam_type = $exam_type;
            $details_result->question_id = $request->q[$i];
            $details_result->batch_id = $batch->id;
            $details_result->student_id = $student->id;
            $details_result->gain_marks = $request->m[$i];
            $details_result->status = 1;
            $total = $total + $details_result->gain_marks;
            $details_result->save();

            if ($exam_type == 'CQ') {
                $questionContentTags = QuestionContentTag::where('question_id', $request->q[$i])->get();
                if ($questionContentTags->count() > 0) {
                    foreach ($questionContentTags as $questionContentTag) {
                        $questionContentTagAnalysis = new QuestionContentTagAnalysis();
                        $questionContentTagAnalysis->content_tag_id = $questionContentTag->content_tag_id;
                        $questionContentTagAnalysis->student_id = $student->id;
                        $questionContentTagAnalysis->exam_type = 'CQ';
                        $questionContentTagAnalysis->question_id = $request->q[$i];
                        $questionContentTagAnalysis->number_of_attempt = 1;
                        $questionContentTagAnalysis->gain_marks = $request->m[$i];
                        $questionContentTagAnalysis->status = 1;
                        $questionContentTagAnalysis->save();
                    }
                }
            }
        }
        $exam_result = new ExamResult();
        $exam_result->exam_id = $exam->id;
        $exam_result->batch_id = $batch->id;
        $exam_result->student_id = $student->id;
        $exam_result->gain_marks = $total;
        $exam_result->status = 1;
        $save = $exam_result->save();
        if ($save) {
            return redirect()->back();
        }
    }

    public function editMarks(Request $request, Batch $batch, Exam $exam, $exam_type, User $student, CreativeQuestion $creativeQuestion)
    {
        // dd($request, $batch, $exam, $exam_type, $student, $creativeQuestion);
        $detailsResult1 = DetailsResult::where('batch_id', $batch->id)
            ->where('student_id', $student->id)
            ->where('question_id', $request->gyanMulokQuestionID)
            ->where('exam_id', $exam->id)->first();
        $detailsResult2 = DetailsResult::where('batch_id', $batch->id)
            ->where('student_id', $student->id)
            ->where('question_id', $request->onudhabonQuestionID)
            ->where('exam_id', $exam->id)->first();
        $detailsResult3 = DetailsResult::where('batch_id', $batch->id)
            ->where('student_id', $student->id)
            ->where('question_id', $request->proyugMulokQuestionID)
            ->where('exam_id', $exam->id)->first();
        $detailsResult4 = DetailsResult::where('batch_id', $batch->id)
            ->where('student_id', $student->id)
            ->where('question_id', $request->ucchotorQuestionID)
            ->where('exam_id', $exam->id)->first();

        $detailsResult1->gain_marks = $request->gyanMulok;
        $detailsResult2->gain_marks = $request->onudhabon;
        $detailsResult3->gain_marks = $request->proyugMulok;
        $detailsResult4->gain_marks = $request->ucchotor;
        $save1 = $detailsResult1->save();
        $save2 = $detailsResult2->save();
        $save3 = $detailsResult3->save();
        $save4 = $detailsResult4->save();

        if ($save1 && $save2 && $save3 && $save4) {
            return redirect()->back();
        }
    }
}
