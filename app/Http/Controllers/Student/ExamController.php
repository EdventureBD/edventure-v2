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

class ExamController extends Controller
{
    public function question(Batch $batch, Exam $exam)
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
        if ($exam->exam_type == 'MCQ') {
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
                $questions = MCQ::where('exam_id', $exam->id)->inRandomOrder()->take($exam->question_limit)->get();
                return view('student.pages_new.batch.exam.batch_exam_mcq', compact('questions', 'exam', 'batch'));
            }
            return view('student.pages.batch.exam.canAttemp', compact('canAttempt', 'exam', 'batch', 'detailsResult', 'analysis', 'weakAnalysis', 'max', 'min'));
        }

        // START OF CQ
        else if ($exam->exam_type == 'CQ') {
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
            if (!($canAttempt)) {
                $show = false;
                return view('student.pages.batch.exam.canAttemp', compact('canAttempt', 'exam', 'batch', 'show', 'detailsResult', 'analysis', 'weakAnalysis', 'max', 'min', 'totalNumber'));
            } else {
                $show = true;
                return view('student.pages.batch.exam.canAttemp', compact('canAttempt', 'exam', 'batch', 'show', 'detailsResult', 'analysis', 'weakAnalysis', 'max', 'min', 'totalNumber'));
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
                return view('student.pages.batch.exam.canAttemp', compact('canAttempt', 'exam', 'batch', 'show', 'detailsResult', 'analysis', 'weakAnalysis', 'max', 'min'));
            } else {
                $show = true;
                return view('student.pages.batch.exam.canAttemp', compact('canAttempt', 'exam', 'batch', 'show', 'detailsResult', 'analysis', 'weakAnalysis', 'max', 'min'));
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
        if ($exam->exam_type == 'MCQ') {
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
                return view('student.pages.batch.exam.batch_exam_mcq', compact('questions', 'exam', 'batch'));
            }
            // return view('student.pages.batch.exam.canAttemp', compact('canAttempt', 'courseLecture', 'exam', 'batch', 'detailsResult', 'analysis', 'weakAnalysis', 'max', 'min'));
            return view('student.pages.batch.exam.canAttemp', compact('canAttempt', 'exam', 'batch', 'detailsResult', 'analysis', 'weakAnalysis', 'max', 'min'));
        }

        // START OF CQ
        else if ($exam->exam_type == 'CQ') {
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
                return view('student.pages.batch.exam.batch_exam_cq_and_assignment', compact('questions', 'exam', 'batch'));
            }
            $canAttempt = ExamResult::where('exam_id', $exam->id)
                ->where('batch_id', $batch->id)
                ->where('student_id', auth()->user()->id)
                ->first();
            if (!($canAttempt)) {
                $show = false;
                // return view('student.pages.batch.exam.canAttemp', compact('canAttempt', 'courseLecture', 'exam', 'batch', 'show', 'detailsResult', 'analysis', 'weakAnalysis', 'max', 'min', 'totalNumber'));
                return view('student.pages.batch.exam.canAttemp', compact('canAttempt', 'exam', 'batch', 'show', 'detailsResult', 'analysis', 'weakAnalysis', 'max', 'min', 'totalNumber'));
            } else {
                $show = true;
                // return view('student.pages.batch.exam.canAttemp', compact('canAttempt', 'courseLecture', 'exam', 'batch', 'show', 'detailsResult', 'analysis', 'weakAnalysis', 'max', 'min', 'totalNumber'));
                return view('student.pages.batch.exam.canAttemp', compact('canAttempt', 'exam', 'batch', 'show', 'detailsResult', 'analysis', 'weakAnalysis', 'max', 'min', 'totalNumber'));
            }
        }
    }

    public function submit(Request $request, Batch $batch, Exam $exam)
    {
        if ($exam->exam_type == 'MCQ') {
            $questions = $request->q;
            $total = 0;
            $number_of_attempt = 0;
            $gain_marks = 0;
            $answers = $request->a;
            for ($i = 1; $i <= sizeOf($questions); $i++) {
                $question = MCQ::Where('id', $questions[$i])->first();
                $number_of_attempt = $question->number_of_attempt + 1;
                if ($question->answer == 1) {
                    $specific = $question->field1;
                } elseif ($question->answer == 2) {
                    $specific = $question->field2;
                } elseif ($question->answer == 3) {
                    $specific = $question->field3;
                } elseif ($question->answer == 4) {
                    $specific = $question->field4;
                }

                for ($j = 1; $j <= sizeOf($answers); $j++) {
                    if (array_key_exists($j, $answers)) {
                        if ($i == $j) {
                            if ($answers[$j] == $question->field1) {
                                if ($answers[$j] == $specific) {
                                    $total = $total + 1;
                                    $gain_marks = $question->gain_marks + 1;
                                }
                            } else if ($answers[$j] == $question->field2) {
                                if ($answers[$j] == $specific) {
                                    $total = $total + 1;
                                    $gain_marks = $question->gain_marks + 1;
                                }
                            } else if ($answers[$j] == $question->field3) {
                                if ($answers[$j] == $specific) {
                                    $total = $total + 1;
                                    $gain_marks = $question->gain_marks + 1;
                                }
                            } else if ($answers[$j] == $question->field4) {
                                if ($answers[$j] == $specific) {
                                    $total = $total + 1;
                                    $gain_marks = $question->gain_marks + 1;
                                }
                            }
                        }
                    }
                }
                $question->number_of_attempt = $number_of_attempt;
                $question->gain_marks = $gain_marks;
                $success_rate = ($question->gain_marks * 100) / $question->number_of_attempt;
                $question->success_rate = $success_rate;
                $question->save();
                $number_of_attempt = 0;
                $gain_marks = 0;
            }
            $exam_result = new ExamResult();
            $exam_result->exam_id = $exam->id;
            $exam_result->batch_id = $batch->id;
            $exam_result->student_id = auth()->user()->id;
            $exam_result->gain_marks = $total;
            $exam_result->status = 1;
            $save = $exam_result->save();
            if ($save) {
                return view('student.pages.batch.exam.mcq_result', compact('questions', 'exam', 'batch', 'answers', 'total', 'gain_marks'));
            }
        }
        if ($exam->exam_type == 'CQ') {
            // dd($request);
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
                return redirect()->route('batch-lecture', $batch)->with('status', "You have successfully complted the CQ exam");
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
}
