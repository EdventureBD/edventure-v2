<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin\CQ;

use App\Models\Admin\PopQuizCQ;
use App\Models\Admin\TopicEndExamCQ;

use App\Models\Admin\Exam;
use App\Models\Admin\Batch;
use Illuminate\Http\Request;
use App\Models\Admin\Assignment;
use App\Http\Controllers\Controller;
use App\Models\Admin\CreativeQuestion;
use App\Models\Admin\PopQuizCreativeQuestion;
use App\Models\Student\exam\ExamPaper;
use App\Models\Student\exam\ExamResult;
use App\Models\Admin\QuestionContentTag;
use App\Models\Admin\StudentExamAttempt;
use App\Models\Admin\TopicEndExamCreativeQuestion;
use App\Models\Student\exam\CqExamPaper;

use App\Models\Student\exam\PopQuizCqExamPaper;
use App\Models\Student\exam\TopicEndExamCqExamPaper;

use App\Models\Student\exam\DetailsResult;
use App\Models\Student\exam\QuestionContentTagAnalysis;

class SubmissionController extends Controller
{
    public function submission(Batch $batch, Exam $exam, $exam_type)
    {
        if ($exam->exam_type == 'MCQ' || $exam->exam_type == 'Aptitude Test') {
            $exam_results = ExamResult::where('batch_id', $batch->id)->where('exam_id', $exam->id)->with(['student', 'batch', 'exam'])->get();
            return view('admin.pages.batch_exam.submission.exam_result', compact('exam_results'));
        }
        elseif($exam->exam_type == 'Topic End Exam' || $exam->exam_type == 'Pop Quiz'){
            $student_exam_attempts = StudentExamAttempt::where('exam_id', $exam->id)->with(['student', 'exam'])->get();

            if($exam->exam_type == 'Pop Quiz'){
                $exam_result_mcq_type = 'Pop Quiz MCQ';
                $exam_result_cq_type = 'Pop Quiz CQ';
            }
            elseif($exam->exam_type == 'Topic End Exam'){
                $exam_result_mcq_type = 'Topic End Exam MCQ';
                $exam_result_cq_type = 'Topic End Exam CQ';
            }

            $mcq_exam_results = ExamResult::where('batch_id', $batch->id)->where('exam_id', $exam->id)->where('exam_type', $exam_result_mcq_type)->with(['student', 'batch', 'exam'])->get();

            $cq_exam_results = ExamResult::where('batch_id', $batch->id)->where('exam_id', $exam->id)->where('exam_type', $exam_result_cq_type)->with(['student', 'batch', 'exam'])->get();

            $exam_results = ExamResult::where('batch_id', $batch->id)->where('exam_id', $exam->id)->with(['student', 'batch', 'exam'])->get();

            // dd($student_exam_attempts, $mcq_exam_results, $cq_exam_results);

            return view('admin.pages.batch_exam.submission.exam_paper_mcq_and_cq', compact('student_exam_attempts', 'batch', 'mcq_exam_results', 'cq_exam_results'));
        }
        elseif($exam->exam_type == 'CQ' || $exam->exam_type == 'Assignment') {
            $student_exam_attempts = StudentExamAttempt::where('exam_id', $exam->id)->with(['student', 'exam'])->get();
            $exam_results = ExamResult::where('batch_id', $batch->id)->where('exam_id', $exam->id)->get();
            return view('admin.pages.batch_exam.submission.exam_paper_submission_student', compact('student_exam_attempts', 'batch', 'exam_results'));
        }

        // if ($exam->exam_type == 'MCQ' || $exam->exam_type == 'Aptitude Test') {
        //     $exam_results = ExamResult::where('batch_id', $batch->id)->where('exam_id', $exam->id)->get();
        //     return view('admin.pages.batch_exam.submission.exam_result', compact('exam_results'));
        // }
        // elseif ($exam->exam_type == 'Topic End Exam' || $exam->exam_type == 'Pop Quiz') {
        //     dd("TEE PQ");
        // }
        // else {
        //     $student_exam_attempts = StudentExamAttempt::where('exam_id', $exam->id)->get();
        //     $exam_results = ExamResult::where('batch_id', $batch->id)->where('exam_id', $exam->id)->get();
        //     return view('admin.pages.batch_exam.submission.exam_paper_submission_student', compact('student_exam_attempts', 'batch', 'exam_results'));
        // }
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
        } 
        else if ($exam->exam_type == 'Assignment') {
            // $exam_papers = ExamPaper::join('assignments', 'assignments.id', 'exam_papers.question_id')
            //     ->where('exam_papers.exam_id', $exam->id)
            //     ->where('exam_papers.batch_id', $batch->id)
            //     ->where('exam_papers.student_id', $student->id)
            //     ->select('exam_papers.*', 'assignments.*')
            //     ->get();

            $exam_papers = ExamPaper::where('exam_id', $exam->id)
                ->where('batch_id', $batch->id)
                ->where('student_id', $student->id)
                ->get();
            $exam_results = DetailsResult::join('assignments', 'assignments.id', 'details_results.question_id')
                ->where('details_results.exam_id', $exam->id)
                ->where('details_results.batch_id', $batch->id)
                ->where('details_results.student_id', $student->id)
                ->select('assignments.*', 'details_results.*')
                ->get();
            // dd($exam_papers);
            return view('admin.pages.batch_exam.submission.assignment_exam_paper_review_and_result', compact('exam_papers', 'batch', 'exam', 'exam_type', 'student', 'exam_results'));
        }
        else if ($exam->exam_type == 'CQ') {
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
        // else if ($exam->exam_type == 'Pop Quiz' || $exam->exam_type == 'Topic End Exam') {

        //     if($exam->exam_type == 'Pop Quiz'){
        //         $database = "pop_quiz_mcqs";
        //     }
        //     elseif($exam->exam_type == 'Topic End Exam'){
        //         $database = "topic_end_exam_mcqs";
        //     }

        //     $details_result = DetailsResult::join( $database , $database.'.id', 'details_results.question_id')
        //     ->where('details_results.batch_id', $batch->id)
        //     ->where('details_results.exam_id', $exam->id)
        //     ->where('details_results.student_id', $student->id)
        //     ->select('details_results.*', $database.'.question as mcq')
        //     ->get();

        //     if($exam->exam_type == 'Pop Quiz'){
        //         $exam_papers = new PopQuizCqExamPaper();
        //     }
        //     elseif($exam->exam_type == 'Topic End Exam'){
        //         $exam_papers = new TopicEndExamCqExamPaper();
        //     }

        //     $exam_papers = $exam_papers->where('batch_id', $batch->id)->where('student_id', $student->id)->get();

        //     dd($exam->exam_type, $details_result, $exam_papers);

        //     $exam_results = DetailsResult::join('c_q_s', 'c_q_s.id', 'details_results.question_id')
        //         ->where('details_results.exam_id', $exam->id)
        //         ->where('details_results.batch_id', $batch->id)
        //         ->where('details_results.student_id', $student->id)
        //         ->select('c_q_s.*', 'details_results.*')
        //         ->get();
        //     // dd($exam_papers, $exam_results);
        //     return view('admin.pages.batch_exam.submission.exam_paper_review_and_result', compact('exam_papers', 'batch', 'exam', 'exam_type', 'student', 'exam_results'));
        // }
    }






    public function seeDetailsMcqOnly(Batch $batch, Exam $exam, $exam_type, User $student){

        if($exam->exam_type == 'Pop Quiz'){
            $database = "pop_quiz_mcqs";
        }
        elseif($exam->exam_type == 'Topic End Exam'){
            $database = "topic_end_exam_mcqs";
        }

        $details_result = DetailsResult::join( $database , $database.'.id', 'details_results.question_id')
        ->where('details_results.batch_id', $batch->id)
        ->where('details_results.exam_id', $exam->id)
        ->where('details_results.student_id', $student->id)
        ->select('details_results.*', $database.'.question as mcq')
        ->get();

        return view('admin.pages.batch_exam.submission.details_exam_result', compact('details_result', 'batch', 'exam', 'exam_type', 'student'));
    }

    public function seeDetailsCqOnly(Batch $batch, Exam $exam, $exam_type, User $student){

        if($exam->exam_type == 'Pop Quiz'){
            $exam_papers = new PopQuizCqExamPaper();
        }
        elseif($exam->exam_type == 'Topic End Exam'){
            $exam_papers = new TopicEndExamCqExamPaper();
        }

        $exam_papers = $exam_papers->where('exam_id', $exam->id)
        ->where('batch_id', $batch->id)
        ->where('student_id', $student->id)
        ->with('creativeQuestion')
        ->get();

        if($exam->exam_type == 'Pop Quiz'){
            $database = "pop_quiz_cqs";
            $relation = 'popQuizCqQuestion';
        }
        elseif($exam->exam_type == 'Topic End Exam'){
            $database = "topic_end_exam_cqs";
            $relation = 'topicEndExamCqQuestion';
        }

        $exam_results = DetailsResult::join( $database, $database.'.id', 'details_results.question_id')
            ->where('details_results.exam_id', $exam->id)
            ->where('details_results.batch_id', $batch->id)
            ->where('details_results.student_id', $student->id)
            ->has($relation)
            ->with($relation.".creativeQuestion")
            ->select($database.'.*', 'details_results.*')
            ->get();

        if($exam->exam_type == 'Pop Quiz'){
            foreach($exam_results as $exam_result){
                $exam_result->cqQuestion = $exam_result->popQuizCqQuestion;
                unset($exam_result->popQuizCqQuestion);
            }
        }
        elseif($exam->exam_type == 'Topic End Exam'){
            foreach($exam_results as $exam_result){
                $exam_result->cqQuestion = $exam_result->topicEndExamCqQuestion;
                unset($exam_result->topicEndExamCqQuestion);
            }
        }

        // dd($exam_papers, $exam_results);

        return view('admin.pages.batch_exam.submission.exam_paper_review_and_result', compact('exam_papers', 'batch', 'exam', 'exam_type', 'student', 'exam_results'));
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

                $cq = CQ::find($request->q[$i]);
                $numberOfAttempt = $cq->number_of_attempt + 1;
                $totalCQMarks = $cq->marks * $numberOfAttempt;
                $cqGainMarks = $cq->gain_marks + $gain_marks;
                $successRate = ($cqGainMarks * 100) / $totalCQMarks;

                $cq->number_of_attempt = $numberOfAttempt;
                $cq->gain_marks = $cqGainMarks;
                $cq->success_rate = $successRate;
                $cq->save();

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
        }
        else if ($exam_type == 'Pop Quiz' || $exam_type == 'Topic End Exam') {
            // dd("HIT", $request, sizeof($request->q));
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
                if($exam_type == "Pop Quiz"){
                    $cq = PopQuizCQ::find($request->q[$i]);
                }
                else if($exam_type == "Topic End Exam"){
                    $cq = TopicEndExamCQ::find($request->q[$i]);
                }
                $numberOfAttempt = $cq->number_of_attempt + 1;
                $totalCQMarks = $cq->marks * $numberOfAttempt;
                $cqGainMarks = $cq->gain_marks + $gain_marks;
                $successRate = ($cqGainMarks * 100) / $totalCQMarks;

                $cq->number_of_attempt = $numberOfAttempt;
                $cq->gain_marks = $cqGainMarks;
                $cq->success_rate = $successRate;
                $cq->save();

                $questionContentTags = QuestionContentTag::where('question_id', $request->q[$i])->get();
                if ($questionContentTags->count() > 0) {
                    foreach ($questionContentTags as $questionContentTag) {
                        $questionContentTagAnalysis = new QuestionContentTagAnalysis();
                        $questionContentTagAnalysis->content_tag_id = $questionContentTag->content_tag_id;
                        $questionContentTagAnalysis->student_id = $student->id;

                        if($exam_type == "Pop Quiz"){
                            $questionContentTagAnalysis->exam_type = 'Pop Quiz CQ';
                        }
                        else if($exam_type == "Topic End Exam"){
                            $questionContentTagAnalysis->exam_type = 'Topic End Exam CQ';
                        }
                        
                        $questionContentTagAnalysis->question_id = $request->q[$i];
                        $questionContentTagAnalysis->number_of_attempt = 1;
                        $questionContentTagAnalysis->gain_marks = $gain_marks;
                        $questionContentTagAnalysis->status = 1;
                        $questionContentTagAnalysis->save();
                    }
                }
            }

            if($exam_type == "Pop Quiz"){
                $cq_type = "Pop Quiz CQ";
            }
            else if($exam_type == "Topic End Exam"){
                $cq_type = "Topic End Exam CQ";
            }

            $exam_result = ExamResult::where('exam_id', $exam->id)
            ->where('exam_type', $cq_type)
            ->where('batch_id', $batch->id)
            ->where('student_id', $student->id)
            ->where('checked', 0)
            ->firstOrFail();
            
            $exam_result->checked = 1;
            $exam_result->gain_marks = $total;
            $save = $exam_result->save();

            if ($save) {
                return redirect()->back();
            }
            // return $this->giveMarksTo($request, $batch, $exam, $exam_type, $student);
        }
        else if ($exam_type == 'Assignment') {
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

    public function editMarks(Request $request, Batch $batch, Exam $exam, $exam_type, User $student, $creative_question_slug)
    {
        if($exam_type == "CQ"){
            $creativeQuestion = CreativeQuestion::where('slug', $creative_question_slug)->firstOrFail();
        }
        elseif($exam_type == "Pop Quiz"){
            $creativeQuestion = PopQuizCreativeQuestion::where('slug', $creative_question_slug)->firstOrFail();
        }
        elseif($exam_type == "Topic End Exam"){
            $creativeQuestion = TopicEndExamCreativeQuestion::where('slug', $creative_question_slug)->firstOrFail();
        }

        // START OF FINDING SPECIFIC QUESTION VALUE
        $detailsResult1 = DetailsResult::where('batch_id', $batch->id)
            ->where('student_id', $student->id)
            ->where('question_id', $request->gyanMulokQuestionID)
            ->where('exam_type', $exam_type)
            ->whereNull('mcq_ans')
            ->where('exam_id', $exam->id)->first();
        $detailsResult2 = DetailsResult::where('batch_id', $batch->id)
            ->where('student_id', $student->id)
            ->where('question_id', $request->onudhabonQuestionID)
            ->where('exam_type', $exam_type)
            ->whereNull('mcq_ans')
            ->where('exam_id', $exam->id)->first();
        $detailsResult3 = DetailsResult::where('batch_id', $batch->id)
            ->where('student_id', $student->id)
            ->where('question_id', $request->proyugMulokQuestionID)
            ->where('exam_type', $exam_type)
            ->whereNull('mcq_ans')
            ->where('exam_id', $exam->id)->first();
        $detailsResult4 = DetailsResult::where('batch_id', $batch->id)
            ->where('student_id', $student->id)
            ->where('question_id', $request->ucchotorQuestionID)
            ->where('exam_type', $exam_type)
            ->whereNull('mcq_ans')
            ->where('exam_id', $exam->id)
            ->first();
        // END OF FINDING SPECIFIC QUESTION VALUE

        // START OF STORING PREVIOUS MARKS OF SPECIFIC QUESTION 
        $previousMarks1 = $detailsResult1->gain_marks;
        $previousMarks2 = $detailsResult2->gain_marks;
        $previousMarks3 = $detailsResult3->gain_marks;
        $previousMarks4 = $detailsResult4->gain_marks;
        // END OF STORING PREVIOUS MARKS OF SPECIFIC QUESTION 

        // START OF STORING EDITED MARKS TO DETAILS RESULT TABLE 
        $detailsResult1->gain_marks = $request->gyanMulok;
        $detailsResult2->gain_marks = $request->onudhabon;
        $detailsResult3->gain_marks = $request->proyugMulok;
        $detailsResult4->gain_marks = $request->ucchotor;

        $detailsResult1->save();
        $detailsResult2->save();
        $detailsResult3->save();
        $detailsResult4->save();
        // END OF STORING EDITED MARKS TO DETAILS RESULT TABLE 

        // START OF STORING EDITED MARKS TO EXAM RESULT TABLE
        if($exam_type == "Pop Quiz" || $exam_type == "Topic End Exam"){
            $exam_type = $exam_type.' CQ';
        }

        $exam_result = ExamResult::where(
            [
                ['exam_id', $exam->id],
                ['batch_id', $batch->id],
                ['student_id', $student->id],
                ['exam_type', $exam_type]
            ]
        )->first();

        $sum_of_previous_marks = $previousMarks1 + $previousMarks2 + $previousMarks3 + $previousMarks4;
        $sum_of_new_marks = $detailsResult1->gain_marks + $detailsResult2->gain_marks + $detailsResult3->gain_marks + $detailsResult4->gain_marks;
        $exam_result->gain_marks = $exam_result->gain_marks - $sum_of_previous_marks + $sum_of_new_marks;
        $exam_result->save();
        // END OF STORING EDITED MARKS TO EXAM RESULT TABLE

        // START OF STORING EDITED MARKS TO RESPECIVE CQ TABLE
        if($exam_type == "CQ"){
            $cq1 = CQ::find($request->gyanMulokQuestionID);
            $cq2 = CQ::find($request->onudhabonQuestionID);
            $cq3 = CQ::find($request->proyugMulokQuestionID);
            $cq4 = CQ::find($request->ucchotorQuestionID);
        }
        elseif($exam_type == "Pop Quiz CQ"){
            $cq1 = PopQuizCQ::find($request->gyanMulokQuestionID);
            $cq2 = PopQuizCQ::find($request->onudhabonQuestionID);
            $cq3 = PopQuizCQ::find($request->proyugMulokQuestionID);
            $cq4 = PopQuizCQ::find($request->ucchotorQuestionID);
        }
        elseif($exam_type == "Topic End Exam CQ"){
            $cq1 = TopicEndExamCQ::find($request->gyanMulokQuestionID);
            $cq2 = TopicEndExamCQ::find($request->onudhabonQuestionID);
            $cq3 = TopicEndExamCQ::find($request->proyugMulokQuestionID);
            $cq4 = TopicEndExamCQ::find($request->ucchotorQuestionID);
        }

        // calculating total marks scored by all students for each CQ
        $newMarks1 = ($cq1->gain_marks - $previousMarks1) + $request->gyanMulok;
        $newMarks2 = ($cq2->gain_marks - $previousMarks2) + $request->onudhabon;
        $newMarks3 = ($cq3->gain_marks - $previousMarks3) + $request->proyugMulok;
        $newMarks4 = ($cq4->gain_marks - $previousMarks4) + $request->ucchotor;

        // calculating attempts per mark for each CQ
        $totalCQMarks1 = $cq1->number_of_attempt * $cq1->marks;
        $totalCQMarks2 = $cq2->number_of_attempt * $cq2->marks;
        $totalCQMarks3 = $cq3->number_of_attempt * $cq3->marks;
        $totalCQMarks4 = $cq4->number_of_attempt * $cq4->marks;

        // calculating and updating success rate for each CQ
        $cq1->success_rate = ($newMarks1 * 100) / $totalCQMarks1;
        $cq2->success_rate = ($newMarks2 * 100) / $totalCQMarks2;
        $cq3->success_rate = ($newMarks3 * 100) / $totalCQMarks3;
        $cq4->success_rate = ($newMarks4 * 100) / $totalCQMarks4;

        $cq1->gain_marks = $newMarks1;
        $cq2->gain_marks = $newMarks2;
        $cq3->gain_marks = $newMarks3;
        $cq4->gain_marks = $newMarks4;

        $cq1->save();
        $cq2->save();
        $cq3->save();
        $cq4->save();
        // END OF STORING EDITED MARKS TO RESPECTIVE CQ TABLE

        return redirect()->back();
    }

    public function checkedPaperOfCQ(Request $request, Batch $batch, Exam $exam, $exam_type, User $student)
    {
        $validateData = $request->validate([
            'checkedPaper' => 'required|mimes:pdf|max:10000'
        ]);

        $checkedPapers = CqExamPaper::where(
            [
                ['exam_id', $exam->id],
                ['batch_id', $batch->id],
                ['student_id', $student->id]
            ]
        )->get();
        return $this->checkedPaper($request, $checkedPapers);
    }

    public function checkedPaperOfAssignment(Request $request, Batch $batch, Exam $exam, $exam_type, User $student)
    {
        $validateData = $request->validate([
            'checkedPaper' => 'required|mimes:pdf|max:10000'
        ]);

        $checkedPapers = ExamPaper::where(
            [
                ['exam_id', $exam->id],
                ['batch_id', $batch->id],
                ['student_id', $student->id]
            ]
        )->get();
        return $this->checkedPaper($request, $checkedPapers);
    }

    private function checkedPaper($request, $checkedPapers)
    {
        $path = '';

        if ($request->file('checkedPaper')) {
            $name = time() . "_" . $request->file('checkedPaper')->getClientOriginalName();
            $path = $request->file('checkedPaper')->storeAs('public/student/exam/answer/CQ', $name);
        }
        foreach ($checkedPapers as $checkedPaper) {
            $checkedPaper->checked_paper = $path;
            $checkedPaper->save();
        }

        return redirect()->back();
    }

    public function editAssignmetnMarks(Request $request, Batch $batch, Exam $exam, $exam_type, User $student, Assignment $assignment)
    {
        // dd($request, $batch, $exam, $exam_type, $student, $assignment);
        $detailsResult = DetailsResult::where('batch_id', $batch->id)
            ->where('student_id', $student->id)
            ->where('question_id', $request->questionID)
            ->where('exam_id', $exam->id)->first();
        $detailsResult->gain_marks = $request->marks;
        $save = $detailsResult->save();
        if ($save) {
            $totals = DetailsResult::where([
                ['exam_id', $exam->id],
                ['batch_id', $batch->id],
                ['student_id', $student->id]
            ])->get();
            $totalGainMarks = 0;
            foreach ($totals as $total) {
                $totalGainMarks += $total->gain_marks;
            }
            $gainMarks = ExamResult::where(
                [
                    ['exam_id', $exam->id],
                    ['batch_id', $batch->id],
                    ['student_id', $student->id]
                ]
            )->first();
            $gainMarks->gain_marks = $totalGainMarks;
            $gainMarks->save();
            return redirect()->back();
        }
    }
}
