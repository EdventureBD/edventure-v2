<?php

namespace App\Http\Controllers\Student;

use App\Models\Admin\CQ;
use App\Models\Admin\MCQ;
use App\Models\Admin\Exam;
use App\Models\Admin\Batch;
use Illuminate\Http\Request;
use App\Models\Admin\Assignment;
use App\Http\Controllers\Controller;
use App\Models\Admin\CreativeQuestion;
use App\Models\Student\exam\ExamPaper;
use App\Models\Student\exam\ExamResult;
use App\Models\Admin\StudentExamAttempt;
use App\Models\Student\exam\CqExamPaper;
use App\Models\Student\exam\DetailsResult;
use App\Models\Student\exam\QuestionContentTagAnalysis;
use App\Utils\Edvanture;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function question(Batch $batch, Exam $exam)
    {
        $totalNumber = 0;
        $detailsResult = DetailsResult::with('cqQuestion')->where('student_id', auth()->user()->id)
            ->where('exam_id', $exam->id)
            ->where('batch_id', $batch->id)
            ->get();
        foreach ($detailsResult as $details) {
            if ($details->exam_type == Edvanture::CQ) {
                $number = CQ::where('id', $details->question_id)->select('marks')->first();
                $totalNumber = $totalNumber + $number->marks;
            } else if ($details->exam_type == Edvanture::MCQ) {
                $number = 1;
                $totalNumber = $totalNumber + $number;
            } else if ($details->exam_type == Edvanture::ASSIGNMENT) {
                $number = Assignment::where('id', $details->question_id)->select('marks')->first();
                $totalNumber = $totalNumber + $number->marks;
            }
        }

        $max = ExamResult::where('exam_id', $exam->id)
            ->where('batch_id', $batch->id)
            ->max('gain_marks');

        $min = ExamResult::where('exam_id', $exam->id)
            ->where('batch_id', $batch->id)
            ->min('gain_marks');

        // START OF MCQ
        if ($exam->exam_type == Edvanture::MCQ) {
            $canAttempt = (new ExamResult())->getExamResult($exam->id, $batch->id, auth()->user()->id);
            if (!empty($canAttempt) && $canAttempt->status == 0) {
                $questions = MCQ::where('exam_id', $exam->id)->inRandomOrder()->take($exam->question_limit)->get();
                // dd($questions->toArray());
                $save = $this->processMCQ($questions->toArray(), [], $batch, $exam, 1, $canAttempt);
                if ($save) {
                    $detailsResult = DetailsResult::with('cqQuestion')->where('student_id', auth()->user()->id)
                        ->where('exam_id', $exam->id)
                        ->where('batch_id', $batch->id)
                        ->get();
                }
            }
            $analysis = DetailsResult::join('question_content_tags', 'details_results.question_id', 'question_content_tags.question_id')
                ->join('content_tags', 'content_tags.id', 'question_content_tags.content_tag_id')
                ->where('question_content_tags.exam_type', "MCQ")
                ->where('details_results.student_id', auth()->user()->id)
                ->where('details_results.batch_id', $batch->id)
                ->where('details_results.exam_id', $exam->id)
                ->select('question_content_tags.*', 'details_results.*', 'content_tags.title as contentTag')
                ->get();
            $weakAnalysis = $analysis;
            if (!$canAttempt) {
                $questions = MCQ::where('exam_id', $exam->id)->inRandomOrder()->take($exam->question_limit)->get();
                //Inserting in the exam result as first attempt
                (new ExamResult())->saveData(['exam_id' => $exam->id, 'batch_id' => $batch->id, 'student_id' => auth()->user()->id, 'gain_marks' => 0, 'status' => 0]);
                return view('student.pages_new.batch.exam.batch_exam_mcq', compact('questions', 'exam', 'batch'));
            }

            return view('student.pages_new.batch.exam.canAttemp', compact('canAttempt', 'exam', 'batch', 'detailsResult', 'analysis', 'weakAnalysis', 'max', 'min'));
        }

        // START OF CQ
        else if ($exam->exam_type == Edvanture::CQ) {
            $canAttempt = CqExamPaper::where('exam_id', $exam->id)
                ->where('batch_id', $batch->id)
                ->where('student_id', auth()->user()->id)
                ->where('exam_type', $exam->exam_type)
                ->first();

            $analysis = DetailsResult::join('question_content_tags', 'details_results.question_id', 'question_content_tags.question_id')
                ->join('content_tags', 'content_tags.id', 'question_content_tags.content_tag_id')
                ->where('question_content_tags.exam_type', "CQ")
                ->where('details_results.student_id', auth()->user()->id)
                ->where('details_results.batch_id', $batch->id)
                ->where('details_results.exam_id', $exam->id)
                ->select('question_content_tags.*', 'details_results.*', 'content_tags.title as contentTag')
                ->get();
            $weakAnalysis = $analysis;

            if (!$canAttempt) {
                // $questions = CQ::where('exam_id', $exam->id)->inRandomOrder()->take($exam->question_limit)->get();
                $questions = CreativeQuestion::where('exam_id', $exam->id)->inRandomOrder()->take($exam->question_limit)->get();
                return view('student.pages_new.batch.exam.batch_exam_cq', compact('questions', 'exam', 'batch'));
            }
            $canAttempt = ExamResult::where('exam_id', $exam->id)
                ->where('batch_id', $batch->id)
                ->where('student_id', auth()->user()->id)
                ->first();
            if (!$canAttempt) {
                $show = false;
                return view('student.pages_new.batch.exam.canAttemp', compact('canAttempt', 'exam', 'batch', 'show', 'detailsResult', 'analysis', 'weakAnalysis', 'max', 'min', 'totalNumber'));
            } else {
                $show = true;
                $exam_paper = (new CqExamPaper())->getCqExamPaper($exam->id, $batch->id, Auth::user()->id);
                // CqExamPaper::where('exam_id', $exam->id)->where('batch_id', $batch->id)->where('student_id', Auth::user()->id)->first();

                return view('student.pages_new.batch.exam.canAttemp', compact('canAttempt', 'exam', 'batch', 'show', 'detailsResult', 'analysis', 'weakAnalysis', 'max', 'min', 'totalNumber', 'exam_paper'));
            }
        }

        // START OF Assignment
        else if ($exam->exam_type == 'Assignment') {
            $canAttempt = ExamPaper::where('exam_id', $exam->id)
                ->where('batch_id', $batch->id)
                ->where('student_id', auth()->user()->id)
                ->where('exam_type', $exam->exam_type)
                ->first();

            $analysis = DetailsResult::join('question_content_tags', 'details_results.question_id', 'question_content_tags.question_id')
                ->join('content_tags', 'content_tags.id', 'question_content_tags.content_tag_id')
                ->where('question_content_tags.exam_type', "MCQ")
                ->where('details_results.student_id', auth()->user()->id)
                ->where('details_results.batch_id', $batch->id)
                ->where('details_results.exam_id', $exam->id)
                ->select('question_content_tags.*', 'details_results.*', 'content_tags.title as contentTag')
                ->get();
            $weakAnalysis = $analysis;

            if (!$canAttempt) {
                $questions = Assignment::where('exam_id', $exam->id)->inRandomOrder()->get();
                return view('student.pages.batch.exam.batch_exam_cq_and_assignment', compact('questions', 'exam', 'batch'));
            }
            $canAttempt = ExamResult::where('exam_id', $exam->id)
                ->where('batch_id', $batch->id)
                ->where('student_id', auth()->user()->id)
                ->first();
            if (empty($canAttempt)) {
                $show = false;
                return view('student.pages_new.batch.exam.canAttemp', compact('canAttempt', 'exam', 'batch', 'show', 'detailsResult', 'analysis', 'weakAnalysis', 'max', 'min'));
            } else {
                $show = true;
                return view('student.pages_new.batch.exam.canAttemp', compact('canAttempt', 'exam', 'batch', 'show', 'detailsResult', 'analysis', 'weakAnalysis', 'max', 'min'));
            }
        }
    }

    public function specialExamQuestion(Batch $batch, Exam $exam)
    {

        $totalNumber = 0;
        $detailsResult = DetailsResult::where('student_id', auth()->user()->id)
            ->where('exam_id', $exam->id)
            ->where('batch_id', $batch->id)
            ->get();
        foreach ($detailsResult as $details) {
            if ($details->exam_type == 'CQ') {
                $number = CQ::where('id', $details->question_id)->select('marks')->first();
                $totalNumber = $totalNumber + $number->marks;
            } else if ($details->exam_type == 'MCQ') {
                $number = 1;
                $totalNumber = $totalNumber + $number;
            } else if ($details->exam_type == 'Assignment') {
                $number = Assignment::where('id', $details->question_id)->select('marks')->first();
                $totalNumber = $totalNumber + $number->marks;
            }
        }

        $max = ExamResult::where('exam_id', $exam->id)
            ->where('batch_id', $batch->id)
            ->max('gain_marks');

        $min = ExamResult::where('exam_id', $exam->id)
            ->where('batch_id', $batch->id)
            ->min('gain_marks');

        // START OF MCQ
        if ($exam->exam_type == Edvanture::MCQ) {
            $canAttempt = ExamResult::where('exam_id', $exam->id)
                ->where('batch_id', $batch->id)
                ->where('student_id', auth()->user()->id)
                ->first();

            $analysis = DetailsResult::join('question_content_tags', 'details_results.question_id', 'question_content_tags.question_id')
                ->join('content_tags', 'content_tags.id', 'question_content_tags.content_tag_id')
                ->where('question_content_tags.exam_type', "MCQ")
                ->where('details_results.student_id', auth()->user()->id)
                ->where('details_results.batch_id', $batch->id)
                ->where('details_results.exam_id', $exam->id)
                ->select('question_content_tags.*', 'details_results.*', 'content_tags.title as contentTag')
                ->get();
            $weakAnalysis = $analysis;

            if (!$canAttempt) {
                $questions = MCQ::where('exam_id', $exam->id)->inRandomOrder()->take(10)->get();
                // return view('student.pages.batch.exam.batch_exam_mcq', compact('questions', 'exam', 'batch', 'courseLecture'));
                return view('student.pages_new.batch.exam.batch_exam_mcq', compact('questions', 'exam', 'batch'));
            }
            // return view('student.pages.batch.exam.canAttemp', compact('canAttempt', 'courseLecture', 'exam', 'batch', 'detailsResult', 'analysis', 'weakAnalysis', 'max', 'min'));
            return view('student.pages_new.batch.exam.canAttemp', compact('canAttempt', 'exam', 'batch', 'detailsResult', 'analysis', 'weakAnalysis', 'max', 'min'));
        }

        // START OF CQ
        else if ($exam->exam_type == Edvanture::MCQ) {
            $canAttempt = ExamPaper::where('exam_id', $exam->id)
                ->where('batch_id', $batch->id)
                ->where('student_id', auth()->user()->id)
                ->where('exam_type', $exam->exam_type)
                ->first();

            $analysis = DetailsResult::join('question_content_tags', 'details_results.question_id', 'question_content_tags.question_id')
                ->join('content_tags', 'content_tags.id', 'question_content_tags.content_tag_id')
                ->where('question_content_tags.exam_type', "CQ")
                ->where('details_results.student_id', auth()->user()->id)
                ->where('details_results.batch_id', $batch->id)
                ->where('details_results.exam_id', $exam->id)
                ->select('question_content_tags.*', 'details_results.*', 'content_tags.title as contentTag')
                ->get();
            $weakAnalysis = $analysis;

            if (!$canAttempt) {
                $questions = CQ::where('exam_id', $exam->id)->get();
                // return view('student.pages.batch.exam.batch_exam_cq_and_assignment', compact('questions', 'exam', 'batch', 'courseLecture'));
                return view('student.pages_new.batch.exam.batch_exam_cq_and_assignment', compact('questions', 'exam', 'batch'));
            }
            $canAttempt = ExamResult::where('exam_id', $exam->id)
                ->where('batch_id', $batch->id)
                ->where('student_id', auth()->user()->id)
                ->first();
            if (!($canAttempt)) {
                $show = false;
                // return view('student.pages.batch.exam.canAttemp', compact('canAttempt', 'courseLecture', 'exam', 'batch', 'show', 'detailsResult', 'analysis', 'weakAnalysis', 'max', 'min', 'totalNumber'));
                return view('student.pages_new.batch.exam.canAttemp', compact('canAttempt', 'exam', 'batch', 'show', 'detailsResult', 'analysis', 'weakAnalysis', 'max', 'min', 'totalNumber'));
            } else {
                $show = true;
                // return view('student.pages.batch.exam.canAttemp', compact('canAttempt', 'courseLecture', 'exam', 'batch', 'show', 'detailsResult', 'analysis', 'weakAnalysis', 'max', 'min', 'totalNumber'));
                return view('student.pages_new.batch.exam.canAttemp', compact('canAttempt', 'exam', 'batch', 'show', 'detailsResult', 'analysis', 'weakAnalysis', 'max', 'min', 'totalNumber'));
            }
        }
    }

    public function submit(Request $request, Batch $batch, Exam $exam)
    {
        if ($exam->exam_type == Edvanture::MCQ) {
            // $result = ExamResult::where(['student_id' => auth()->user()->id, 'exam_id' => $exam->id, 'batch_id' => $batch->id])->first();
            $result = (new ExamResult())->getExamResult($exam->id, $batch->id, auth()->user()->id);
            if ($result && $result->status == 1) {
                return $this->sendResponse([]);
            }
            $questions = $request->q;
            $answers = $request->a;
            $save = $this->processMCQ($questions, $answers, $batch, $exam, 1, $result);
            if ($save) {
                if ($request->ajax()) {
                    return $this->sendResponse([]);
                }
                return view('student.pages_new.batch.exam.mcq_result', compact('questions', 'exam', 'batch', 'answers', 'total', 'gain_marks'));
            }
        }
        if ($exam->exam_type == 'CQ') {
            // dd($request->all());
            // return $this->examPaper($request, $batch, $exam);
            $validateData = $request->validate([
                'submitted_text' => 'nullable|string',
                'file' => 'nullable|mimes:pdf|max:10000',
                'ques' => 'required'
            ]);
            // dd($request);
            $path = '';

            if ($request->file('file')) {
                $name = time() . "_" . $request->file('file')->getClientOriginalName();
                $path = $request->file('file')->storeAs('public/student/exam/answer/CQ', $name);
            }

            for ($i = 1; $i <= sizeof($request->ques); $i++) {
                $exam_paper = new CqExamPaper();
                $exam_paper->creative_question_id = $request->ques[$i];
                $exam_paper->exam_id = $exam->id;
                $exam_paper->exam_type = $exam->exam_type;
                $exam_paper->batch_id = $batch->id;
                $exam_paper->student_id = auth()->user()->id;
                $exam_paper->submitted_text = $request->submitted_text;
                $exam_paper->submitted_pdf = $path;
                $exam_paper->status = 1;
                $save = $exam_paper->save();
            }

            $student_exam_attempt = new StudentExamAttempt();
            $student_exam_attempt->student_id = auth()->user()->id;
            $student_exam_attempt->exam_id = $exam->id;
            $student_exam_attempt->is_completed = 1;
            $student_exam_attempt->attended_at = now();
            $student_exam_attempt->save();

            if ($save) {
                // return redirect()->route('batch-lecture', $batch)->with('status', "You have successfully submitted the CQ exam paper.");
                $show = false;
                // return view('student.pages.batch.exam.canAttemp', compact('canAttempt', 'courseLecture', 'exam', 'batch', 'show', 'detailsResult', 'analysis', 'weakAnalysis', 'max', 'min', 'totalNumber'));
                return view('student.pages_new.batch.exam.canAttemp', compact(
                    // 'canAttempt',
                    'exam',
                    'batch',
                    'show',
                    // 'detailsResult', 'analysis', 'weakAnalysis', 'max', 'min', 'totalNumber'
                ));
            }
        }
        if ($exam->exam_type == 'Assignment') {
            return $this->examPaper($request, $batch, $exam);
        }
    }

    private function examPaper($request, $batch, $exam)
    {
        $validateData = $request->validate([
            'submitted_text' => 'nullable|string',
            'file' => 'nullable|mimes:pdf|max:10000',
        ]);
        $path = '';

        if ($request->file('file')) {
            $name = time() . "_" . $request->file('file')->getClientOriginalName();
            $path = $request->file('file')->storeAs('public/student/exam/answer/CQ', $name);
        }

        for ($i = 1; $i <= sizeof($request->ques); $i++) {
            $exam_paper = new ExamPaper();
            $exam_paper->question_id = $request->ques[$i];
            $exam_paper->exam_id = $exam->id;
            $exam_paper->exam_type = $exam->exam_type;
            $exam_paper->batch_id = $batch->id;
            $exam_paper->student_id = auth()->user()->id;
            $exam_paper->submitted_text = $request->submitted_text;
            $exam_paper->submitted_pdf = $path;
            $exam_paper->status = 1;
            $save = $exam_paper->save();
        }

        $student_exam_attempt = new StudentExamAttempt();
        $student_exam_attempt->student_id = auth()->user()->id;
        $student_exam_attempt->exam_id = $exam->id;
        $student_exam_attempt->is_completed = 1;
        $student_exam_attempt->attended_at = now();
        $student_exam_attempt->save();

        if ($save) {
            return redirect()->route('batch-lecture', $batch)->with('status', "You have successfully complted the CQ exam");
        }
    }


    //
    // public function question(Batch $batch, CourseLecture $courseLecture, Exam $exam)
    // {
    //     $totalNumber = 0;
    //     $detailsResult = DetailsResult::where('student_id', auth()->user()->id)
    //         ->where('exam_id', $exam->id)
    //         ->where('batch_id', $batch->id)
    //         ->get();
    //     foreach ($detailsResult as $details) {
    //         if ($details->exam_type == 'CQ') {
    //             $number = CQ::where('id', $details->question_id)->select('marks')->first();
    //             $totalNumber = $totalNumber + $number->marks;
    //         } else if ($details->exam_type == 'MCQ') {
    //             $number = 1;
    //             $totalNumber = $totalNumber + $number;
    //         } else if ($details->exam_type == 'Assignment') {
    //             $number = Assignment::where('id', $details->question_id)->select('marks')->first();
    //             $totalNumber = $totalNumber + $number->marks;
    //         }
    //     }

    //     $max = ExamResult::where('exam_id', $exam->id)
    //         ->where('batch_id', $batch->id)
    //         ->max('gain_marks');

    //     $min = ExamResult::where('exam_id', $exam->id)
    //         ->where('batch_id', $batch->id)
    //         ->min('gain_marks');

    //     // START OF MCQ
    //     if ($exam->exam_type == 'MCQ') {
    //         $canAttempt = ExamResult::where('exam_id', $exam->id)
    //             ->where('batch_id', $batch->id)
    //             ->where('student_id', auth()->user()->id)
    //             ->first();

    //         $analysis = DetailsResult::join('question_content_tags', 'details_results.question_id', 'question_content_tags.question_id')
    //         ->join('content_tags', 'content_tags.id', 'question_content_tags.content_tag_id')
    //         ->where('question_content_tags.exam_type', "MCQ")
    //             ->where('details_results.student_id', auth()->user()->id)
    //             ->where('details_results.batch_id', $batch->id)
    //             ->where('details_results.exam_id', $exam->id)
    //             ->select('question_content_tags.*', 'details_results.*', 'content_tags.title as contentTag')
    //             ->get();
    //         $weakAnalysis = $analysis;

    //         if (!$canAttempt) {
    //             $questions = MCQ::where('exam_id', $exam->id)->inRandomOrder()->take(10)->get();
    //             return view('student.pages.batch.exam.batch_exam_mcq', compact('questions', 'exam', 'batch', 'courseLecture'));
    //         }
    //         return view('student.pages.batch.exam.canAttemp', compact('canAttempt', 'courseLecture', 'exam', 'batch', 'detailsResult', 'analysis', 'weakAnalysis', 'max', 'min'));
    //     }

    //     // START OF CQ
    //     else if ($exam->exam_type == 'CQ') {
    //         $canAttempt = ExamPaper::where('exam_id', $exam->id)
    //             ->where('batch_id', $batch->id)
    //             ->where('student_id', auth()->user()->id)
    //             ->where('exam_type', $exam->exam_type)
    //             ->first();

    //         $analysis = DetailsResult::join('question_content_tags', 'details_results.question_id', 'question_content_tags.question_id')
    //         ->join('content_tags', 'content_tags.id', 'question_content_tags.content_tag_id')
    //         ->where('question_content_tags.exam_type', "CQ")
    //             ->where('details_results.student_id', auth()->user()->id)
    //             ->where('details_results.batch_id', $batch->id)
    //             ->where('details_results.exam_id', $exam->id)
    //             ->select('question_content_tags.*', 'details_results.*', 'content_tags.title as contentTag')
    //             ->get();
    //         $weakAnalysis = $analysis;

    //         if (!$canAttempt) {
    //             $questions = CQ::where('exam_id', $exam->id)->get();
    //             return view('student.pages.batch.exam.batch_exam_cq_and_assignment', compact('questions', 'exam', 'batch', 'courseLecture'));
    //         }
    //         $canAttempt = ExamResult::where('exam_id', $exam->id)
    //             ->where('batch_id', $batch->id)
    //             ->where('student_id', auth()->user()->id)
    //             ->first();
    //         if (!($canAttempt)) {
    //             $show = false;
    //             return view('student.pages.batch.exam.canAttemp', compact('canAttempt', 'courseLecture', 'exam', 'batch', 'show', 'detailsResult', 'analysis', 'weakAnalysis', 'max', 'min', 'totalNumber'));
    //         } else {
    //             $show = true;
    //             return view('student.pages.batch.exam.canAttemp', compact('canAttempt', 'courseLecture', 'exam', 'batch', 'show', 'detailsResult', 'analysis', 'weakAnalysis', 'max', 'min', 'totalNumber'));
    //         }
    //     }

    //     // START OF Assignment
    //     else if ($exam->exam_type == 'Assignment') {
    //         $canAttempt = ExamPaper::where('exam_id', $exam->id)
    //             ->where('batch_id', $batch->id)
    //             ->where('student_id', auth()->user()->id)
    //             ->where('exam_type', $exam->exam_type)
    //             ->first();

    //         $analysis = DetailsResult::join('question_content_tags', 'details_results.question_id', 'question_content_tags.question_id')
    //         ->join('content_tags', 'content_tags.id', 'question_content_tags.content_tag_id')
    //         ->where('question_content_tags.exam_type', "MCQ")
    //             ->where('details_results.student_id', auth()->user()->id)
    //             ->where('details_results.batch_id', $batch->id)
    //             ->where('details_results.exam_id', $exam->id)
    //             ->select('question_content_tags.*', 'details_results.*', 'content_tags.title as contentTag')
    //             ->get();
    //         $weakAnalysis = $analysis;

    //         if (!$canAttempt) {
    //             $questions = Assignment::where('exam_id', $exam->id)->get();
    //             return view('student.pages.batch.exam.batch_exam_cq_and_assignment', compact('questions', 'exam', 'batch', 'courseLecture'));
    //         }
    //         $canAttempt = ExamResult::where('exam_id', $exam->id)
    //             ->where('batch_id', $batch->id)
    //             ->where('student_id', auth()->user()->id)
    //             ->first();
    //         if (empty($canAttempt)) {
    //             $show = false;
    //             return view('student.pages.batch.exam.canAttemp', compact('canAttempt', 'courseLecture', 'exam', 'batch', 'show', 'detailsResult', 'analysis', 'weakAnalysis', 'max', 'min'));
    //         } else {
    //             $show = true;
    //             return view('student.pages.batch.exam.canAttemp', compact('canAttempt', 'courseLecture', 'exam', 'batch', 'show', 'detailsResult', 'analysis', 'weakAnalysis', 'max', 'min'));
    //         }
    //     }
    // }
    //

    protected function formatMcqAnswers($answers)
    {
        $for_ans = [];
        if (!empty($answers)) {
            foreach ($answers as $answer) {
                $ans_arr = explode('_', $answer);
                $for_ans[$ans_arr[0]] = $ans_arr[1];
            }
        }
        return $for_ans;
    }

    private function processMCQ($questions, $answers, $batch, $exam, $status = 0, $result = null)
    {
        // $questions = $request->q;
        $total = 0;
        // $answers = $request->a;
        $input = [];
        $input['exam_id'] = $exam->id;
        $input['batch_id'] = $batch->id;
        $input['student_id'] = auth()->user()->id;
        $input['status'] = $status;
        $fAns = $this->formatMcqAnswers($answers);
        foreach ($questions as $question) {
            $qus_input = [];
            $qus_input['number_of_attempt'] = $question['number_of_attempt'] + 1;
            $qus_input['gain_marks'] = $question['gain_marks'];
            if (!empty($fAns[$question['id']]) && $fAns[$question['id']] == $question['answer']) {
                $total = $total + 1;
                $qus_input['gain_marks'] = $question['gain_marks'] + 1;
            }
            $qus_input['success_rate'] = ($qus_input['gain_marks'] * 100) / $qus_input['number_of_attempt'];
            (new MCQ())->saveData($qus_input, $question['id']); //updating question

            //saving in the DetailsResuls
            $input['exam_type'] = Edvanture::MCQ;
            $input['gain_marks'] = !empty($fAns[$question['id']]) && $fAns[$question['id']] == $question['answer'] ? 1 : 0;
            $input['mcq_ans'] = !empty($fAns[$question['id']]) ? $fAns[$question['id']] : 0;
            $input['question_id'] = $question['id'];
            (new DetailsResult())->saveData($input);

            //saving in the QuestionContentTagAnalysis
            (new QuestionContentTagAnalysis())->saveQuesConTagAnalysis($input);
        }
        //saving in the ExamResults
        $input['gain_marks'] = $total;
        if ($result) {
            $save = (new ExamResult())->saveData($input, $result->id);
        } else {
            $save = (new ExamResult())->saveData($input);
        }
        return $save;
    }
}
