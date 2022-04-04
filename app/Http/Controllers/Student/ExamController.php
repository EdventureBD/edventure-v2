<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Utils\Edvanture;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

// models
use App\Models\Admin\CQ;
use App\Models\Admin\MCQ;
use App\Models\Admin\Assignment;
use App\Models\Admin\AptitudeTestMCQ;
use App\Models\Admin\Exam;
use App\Models\Admin\Batch;
use App\Models\Admin\Course;
use App\Models\Admin\CourseLecture;
use App\Models\Admin\CourseTopic;
use App\Models\Admin\CreativeQuestion;
use App\Models\Admin\TopicEndExamMCQ;
use App\Models\Admin\TopicEndExamCreativeQuestion;
use App\Models\Admin\PopQuizMCQ;
use App\Models\Admin\PopQuizCreativeQuestion;
use App\Models\Admin\QuestionContentTag;
use App\Models\Student\exam\ExamPaper;
use App\Models\Student\exam\ExamResult;
use App\Models\Admin\StudentExamAttempt;
use App\Models\Student\exam\CqExamPaper;
use App\Models\Student\exam\TopicEndExamCqExamPaper;
use App\Models\Student\exam\PopQuizCqExamPaper;
use App\Models\Student\exam\DetailsResult;
use App\Models\Student\exam\QuestionContentTagAnalysis;


class ExamController extends Controller
{
    public function question(Batch $batch, Exam $exam)
    {
        $totalNumber = 0;
        // Getting all exam details
        $detailsResult = DetailsResult::with('cqQuestion')->where('student_id', auth()->user()->id)
            ->where('exam_id', $exam->id)
            ->where('batch_id', $batch->id)
            ->get();

        // Calculate total marks using all the exam details
        foreach ($detailsResult as $details) {

            if ($details->exam_type == Edvanture::CQ) {
                $number = CQ::where('id', $details->question_id)->select('marks')->first();
                $totalNumber = $totalNumber + $number->marks;
            }
            else if ($details->exam_type == Edvanture::MCQ) {
                $number = 1;
                $totalNumber = $totalNumber + $number;
            }
            else if ($details->exam_type == Edvanture::ASSIGNMENT) {
                $number = Assignment::where('id', $details->question_id)->select('marks')->first();
                $totalNumber = $totalNumber + $number->marks;
            }
        }

        // Get max marks gained
        $max = ExamResult::where('exam_id', $exam->id)
            ->where('batch_id', $batch->id)
            ->max('gain_marks');

        // Get min marks gained
        $min = ExamResult::where('exam_id', $exam->id)
            ->where('batch_id', $batch->id)
            ->min('gain_marks');

        // START OF MCQ
        if ($exam->exam_type == Edvanture::MCQ) {
            $canAttempt = (new ExamResult())->getExamResult($exam->id, $batch->id, auth()->user()->id);
            //Code for blocking student page refresh
            // if (!empty($canAttempt) && $canAttempt->status == 0) {
            //     $questions = MCQ::where('exam_id', $exam->id)->inRandomOrder()->take($exam->question_limit)->get();
            //     // dd($questions->toArray());
            //     $save = $this->processMCQ($questions->toArray(), [], $batch, $exam, 1, $canAttempt);
            //     if ($save) {
            //         $detailsResult = DetailsResult::with('cqQuestion')->where('student_id', auth()->user()->id)
            //             ->where('exam_id', $exam->id)
            //             ->where('batch_id', $batch->id)
            //             ->get();
            //     }
            // }
            $analysis = DetailsResult::join('question_content_tags', 'details_results.question_id', 'question_content_tags.question_id')
                ->join('content_tags', 'content_tags.id', 'question_content_tags.content_tag_id')
                ->where('question_content_tags.exam_type', "MCQ")
                ->where('details_results.student_id', auth()->user()->id)
                ->where('details_results.batch_id', $batch->id)
                ->where('details_results.exam_id', $exam->id)
                ->select('question_content_tags.*', 'details_results.*', 'content_tags.title as contentTag')
                ->get();
            $weakAnalysis = $analysis;
            //Giving access to student if they miss for first time or reload page
            if (!$canAttempt || ($canAttempt && $canAttempt->status == 0)) {
                $questions = MCQ::where('exam_id', $exam->id)->inRandomOrder()->take($exam->question_limit)->get();
                //Inserting in the exam result as first attempt
                (new ExamResult())->saveData(['exam_id' => $exam->id, 'exam_type' => $exam->exam_type, 'batch_id' => $batch->id, 'student_id' => auth()->user()->id, 'gain_marks' => 0, 'status' => 0]);
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
            $exam_paper = ExamPaper::where('exam_id', $exam->id)
                ->where('batch_id', $batch->id)
                ->where('student_id', auth()->user()->id)
                ->where('exam_type', $exam->exam_type)
                ->first();

            // $analysis = DetailsResult::join('question_content_tags', 'details_results.question_id', 'question_content_tags.question_id')
            //     ->join('content_tags', 'content_tags.id', 'question_content_tags.content_tag_id')
            //     ->where('question_content_tags.exam_type', "MCQ")
            //     ->where('details_results.student_id', auth()->user()->id)
            //     ->where('details_results.batch_id', $batch->id)
            //     ->where('details_results.exam_id', $exam->id)
            //     ->select('question_content_tags.*', 'details_results.*', 'content_tags.title as contentTag')
            //     ->get();
            // $weakAnalysis = $analysis;

            if (!$exam_paper) {
                $questions = Assignment::where('exam_id', $exam->id)->inRandomOrder()->get();
                // dd($questions);
                return view('student.pages_new.batch.exam.batch_exam_assignment', compact('questions', 'exam', 'batch'));
            }
            $canAttempt = ExamResult::where('exam_id', $exam->id)
                ->where('batch_id', $batch->id)
                ->where('student_id', auth()->user()->id)
                ->first();
            if (empty($canAttempt)) {
                $show = false;
                return view('student.pages_new.batch.exam.canAttemp', compact('canAttempt', 'exam', 'batch', 'show', 'detailsResult', 'max', 'min'));
            } else {
                $show = true;
                return view('student.pages_new.batch.exam.assignment_result', compact('canAttempt', 'exam', 'batch', 'show', 'detailsResult', 'exam_paper', 'max', 'min'));
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
        else if ($exam->exam_type == Edvanture::CQ) {
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

        if ($exam->exam_type == Edvanture::APTITUDETEST) {
            $result = (new ExamResult())->getExamResult($exam->id, $batch->id, auth()->user()->id);
            if ($result && $result->status == 1) {
                return $this->sendResponse([]);
            }
            $questions = $request->q;
            $answers = $request->a;
            $save = $this->processAptitudeTestMCQ($questions, $answers, $batch, $exam, 1, $result);
            if ($save) {
                if ($request->ajax()) {
                    return $this->sendResponse([]);
                }

                return view('student.pages_new.batch.exam.mcq_result', compact('questions', 'exam', 'batch', 'answers', 'total', 'gain_marks'));
            }
        }

        if ($exam->exam_type == Edvanture::CQ) {
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
        
        if ($exam->exam_type == Edvanture::TOPICENDEXAM || $exam->exam_type == Edvanture::POPQUIZ) {
            if ($exam->exam_type == Edvanture::TOPICENDEXAM){
                $exam_type_cq = "Topic End Exam CQ";
                $exam_type_mcq = "Topic End Exam MCQ";
            }
            elseif($exam->exam_type == Edvanture::POPQUIZ){
                $exam_type_cq = "Pop Quiz CQ";
                $exam_type_mcq = "Pop Quiz MCQ";
            }

            $cq_result = ExamResult::where('exam_id', $exam->id)->where('batch_id', $batch->id)->where('student_id', auth()->user()->id)->where('exam_type', $exam_type_cq)->first();
            $mcq_result = ExamResult::where('exam_id', $exam->id)->where('batch_id', $batch->id)->where('student_id', auth()->user()->id)->where('exam_type', $exam_type_mcq)->first();

            $validateData = $request->validate([
                'submitted_text' => 'nullable|string',
                'file' => 'nullable|mimes:pdf|max:10000',
                'mcq_ques' => 'nullable',
                'cq_ques' => 'nullable',
            ]);

            if(!$mcq_result && $request->has('mcq_ques')){
                $total = 0;
                foreach($request->mcq_ques as $key => $mcq){
                    // find corresponding mcq question by id
                    if($exam->exam_type == Edvanture::TOPICENDEXAM){
                        $mcq_question = TopicEndExamMCQ::find($key);
                    }
                    elseif($exam->exam_type == Edvanture::POPQUIZ){
                        $mcq_question = PopQuizMCQ::find($key);

                        $question_content_tag = QuestionContentTag::where('exam_type', $exam_type_mcq)->where('question_id', $key)->first();

                        $content_tag_analysis = new QuestionContentTagAnalysis();
                        $content_tag_analysis->content_tag_id = $question_content_tag->content_tag_id;
                        $content_tag_analysis->student_id = auth()->user()->id;
                        $content_tag_analysis->exam_type = $exam_type_mcq;
                        $content_tag_analysis->question_id = $question_content_tag->question_id;
                        $content_tag_analysis->number_of_attempt = 1;
                        if($mcq == $mcq_question->answer){
                            $content_tag_analysis->gain_marks = 1;
                        }
                        else{
                            $content_tag_analysis->gain_marks = 0;
                        }
                        $content_tag_analysis->status = 1;
                        $content_tag_analysis->save();
                    }
                    
                    $details_result = new DetailsResult();
                    $details_result->exam_id = $exam->id;
                    $details_result->exam_type = $exam->exam_type;
                    $details_result->question_id = $mcq_question->id;
                    $details_result->batch_id = $batch->id;
                    $details_result->student_id = auth()->user()->id;
                    $details_result->status = 1;
                    $details_result->mcq_ans = $mcq;

                    if($mcq == $mcq_question->answer){
                        $details_result->gain_marks = 1;
                        $total++;
                    }
                    else{
                        $details_result->gain_marks = 0;
                    }

                    $details_result->save();
                }

                // Store exam results for mcq
                $exam_result = new ExamResult();
                $exam_result->exam_id = $exam->id;
                if($exam->exam_type == Edvanture::POPQUIZ){
                    $exam_result->exam_type = "Pop Quiz MCQ";
                }
                else if($exam->exam_type == Edvanture::TOPICENDEXAM){
                    $exam_result->exam_type = "Topic End Exam MCQ";
                }
                $exam_result->batch_id = $batch->id;
                $exam_result->student_id = auth()->user()->id;
                $exam_result->gain_marks = $total;
                $exam_result->status = 1;
                $exam_result->save();
            }

            if(!$cq_result && $request->has('cq_ques')){
                $path = '';
                if ($request->file('file')) {
                    $name = time() . "_" . $request->file('file')->getClientOriginalName();
                    if($exam->exam_type == Edvanture::TOPICENDEXAM){
                        $path = $request->file('file')->storeAs('public/student/exam/answer/TopicEndExamCQ', $name);
                    }
                    elseif($exam->exam_type == Edvanture::POPQUIZ){
                        $path = $request->file('file')->storeAs('public/student/exam/answer/PopQuizCQ', $name);
                    }
                }

                for ($i = 1; $i <= sizeof($request->cq_ques); $i++) {
                    if($exam->exam_type == Edvanture::TOPICENDEXAM){
                        $exam_paper = new TopicEndExamCqExamPaper();
                    }
                    elseif($exam->exam_type == Edvanture::POPQUIZ){
                        $exam_paper = new PopQuizCqExamPaper();
                    }
                    $exam_paper->creative_question_id = $request->cq_ques[$i];
                    $exam_paper->exam_id = $exam->id;
                    $exam_paper->exam_type = $exam->exam_type;
                    $exam_paper->batch_id = $batch->id;
                    $exam_paper->student_id = auth()->user()->id;
                    $exam_paper->submitted_text = $request->submitted_text;
                    $exam_paper->submitted_pdf = $path;
                    $exam_paper->status = 1;
                    $exam_paper->save();
                }

                $student_exam_attempt = new StudentExamAttempt();
                $student_exam_attempt->student_id = auth()->user()->id;
                $student_exam_attempt->exam_id = $exam->id;
                $student_exam_attempt->is_completed = 1;
                $student_exam_attempt->attended_at = now();
                $student_exam_attempt->save();

                // Store exam results for cq
                $exam_result = new ExamResult();
                $exam_result->exam_id = $exam->id;
                if($exam->exam_type == Edvanture::POPQUIZ){
                    $exam_result->exam_type = "Pop Quiz CQ";
                }
                else if($exam->exam_type == Edvanture::TOPICENDEXAM){
                    $exam_result->exam_type = "Topic End Exam CQ";
                }
                $exam_result->batch_id = $batch->id;
                $exam_result->student_id = auth()->user()->id;
                $exam_result->gain_marks = 0;
                $exam_result->status = 1;
                $exam_result->checked = 0;
                $exam_result->save();
            }

            if($cq_result && $cq_result->checked == 0){

                $course_topic = CourseTopic::where('id', $exam->topic_id)->first();
                // Get Next Pop Quiz
                if($exam->exam_type == "Pop Quiz"){

                    // Get Next Pop Quiz for link generation
                    $next_exam = Exam::where(function ($query)use($exam){
                        $query->where('exam_type', 'Pop Quiz')->orderBy('order')->where('order', '>', $exam->order);
                    })
                    // ->where('order', '>', $exam->order)
                    ->where('course_id', $exam->course_id)
                    ->where('topic_id', $exam->topic_id)
                    ->with([
                        'course_lectures' => function($query){
                            return $query->select('id', 'slug', 'course_id', 'topic_id', 'exam_id');
                        },
                    ])
                    ->select('id', 'slug', 'course_id', 'topic_id', 'exam_type')
                    ->first();

                    // if next pop quiz is not found, get topic end exam
                    if(empty($next_exam)){
                        $next_exam = Exam::where(function ($query)use($exam){
                            $query->where('exam_type', 'Topic End Exam');
                        })
                        // ->where('order', '>', $exam->order)
                        ->where('course_id', $exam->course_id)
                        ->where('topic_id', $exam->topic_id)
                        ->with([
                            'course_lectures' => function($query){
                                return $query->select('id', 'slug', 'course_id', 'topic_id', 'exam_id');
                            },
                        ])
                        ->select('id', 'slug', 'course_id', 'topic_id', 'exam_type')
                        ->first();
                    }

                    // If next pop quiz has lecture, then generate link for that
                    if(count($next_exam->course_lectures) > 0){
                        $next_link = route('topic_lecture', [$batch->slug, $next_exam->course_lectures[0]->slug]);
                    }
                    // else generate link for the quiz
                    else{
                        $next_link = route('batch-test', [$course_topic->slug, $batch->slug, $next_exam->id, $next_exam->exam_type]);
                    }
                }

                return view('student.pages_new.batch.exam.batch_exam_not_checked', compact('batch', 'exam'));
            }

            else{
                $course_topic = CourseTopic::where('id', $exam->topic_id)->first();
                Session::flash('exam_exists_message', 'You already attempted this exam! Here are your results.');
                return $this->batchTest($course_topic, $batch, $exam->id, $exam->exam_type);
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

    private function processAptitudeTestMCQ($questions, $answers, $batch, $exam, $status = 0, $result = null)
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
            (new AptitudeTestMCQ())->saveData($qus_input, $question['id']); //updating question

            //saving in the DetailsResuls Store for each iteration
            $input['exam_type'] = Edvanture::APTITUDETEST;
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

    public function reattemptBatchTest(CourseTopic $course_topic, Batch $batch, $exam_id, $exam_type){

        if($exam_type == Edvanture::APTITUDETEST){
            $details_results = DetailsResult::where('exam_id', $exam_id)
                ->where('exam_type', 'Aptitude Test')
                ->where('batch_id', $batch->id)
                ->where('student_id', auth()->user()->id)
                ->with('atQuestion')
                ->get();

            foreach($details_results as $details_result){
                $question_content_tag_analysis = QuestionContentTagAnalysis::where('student_id', auth()->user()->id)
                ->where('exam_type', 'Aptitude Test')
                ->where('question_id', $details_result->atQuestion->id)
                ->get();

                foreach($question_content_tag_analysis as $tags){
                    $tags->delete();
                }

                $details_result->delete();
            }

            $exam_result = ExamResult::where('exam_id', $exam_id)->where('exam_type', 'Aptitude Test')->where('batch_id', $batch->id)->where('student_id', auth()->user()->id)->first();
            $exam_result->delete();

            return $this->batchTest($course_topic, $batch, $exam_id, $exam_type);
        }
        elseif($exam_type == Edvanture::POPQUIZ || $exam_type == Edvanture::TOPICENDEXAM){

            if($exam_type == Edvanture::POPQUIZ){
                $cq_exam_papers = PopQuizCqExamPaper::where('exam_id', $exam_id)->where('exam_type', $exam_type)->where('student_id', auth()->user()->id)->get();
            }
            elseif($exam_type == Edvanture::TOPICENDEXAM){
                $cq_exam_papers = TopicEndExamCqExamPaper::where('exam_id', $exam_id)->where('exam_type', $exam_type)->where('student_id', auth()->user()->id)->get();
            }

            foreach($cq_exam_papers as $cq_exam_paper){
                $cq_exam_paper->delete();
            }

            $mcq_details_results = DetailsResult::where('exam_id', $exam_id)
            ->where('exam_type', $exam_type)
            ->where('batch_id', $batch->id)
            ->where('student_id', auth()->user()->id)
            ->whereNotNull('mcq_ans')
            ->get();

            $cq_details_results = DetailsResult::where('exam_id', $exam_id)
            ->where('exam_type', $exam_type)
            ->where('batch_id', $batch->id)
            ->where('student_id', auth()->user()->id)
            ->whereNull('mcq_ans')
            ->get();

            foreach($mcq_details_results as $details_result){
                $question_content_tag_analysis = QuestionContentTagAnalysis::where('student_id', auth()->user()->id)
                ->where('exam_type', $exam_type.' MCQ')
                ->where('question_id', $details_result->question_id)
                ->get();

                foreach($question_content_tag_analysis as $tags){
                    $tags->delete();
                }

                $details_result->delete();
            }

            foreach($cq_details_results as $details_result){
                $question_content_tag_analysis = QuestionContentTagAnalysis::where('student_id', auth()->user()->id)
                ->where('exam_type', $exam_type.' CQ')
                ->where('question_id', $details_result->question_id)
                ->get();

                foreach($question_content_tag_analysis as $tags){
                    $tags->delete();
                }

                $details_result->delete();
            }

            $exam_result = ExamResult::where('exam_id', $exam_id)->where('exam_type', $exam_type.' MCQ')->where('batch_id', $batch->id)->where('student_id', auth()->user()->id)->first();
            $exam_result->delete();
            $exam_result = ExamResult::where('exam_id', $exam_id)->where('exam_type', $exam_type.' CQ')->where('batch_id', $batch->id)->where('student_id', auth()->user()->id)->first();
            $exam_result->delete();

            $student_exam_attempt = StudentExamAttempt::where('exam_id', $exam_id)->where('student_id', auth()->user()->id)->first();
            $student_exam_attempt->delete();

            return $this->batchTest($course_topic, $batch, $exam_id, $exam_type);
        }
    }

    public function batchTest(CourseTopic $course_topic, Batch $batch, $exam_id, $exam_type){

        $course = Course::where('id', $course_topic->course_id)->firstOrFail();

        if ($exam_type == Edvanture::APTITUDETEST) {
                $exam = Exam::where('id', $exam_id)->where('exam_type', $exam_type)->where('topic_id', $course_topic->id)->firstOrFail();

                $canAttempt = (new ExamResult())->getExamResult($exam->id, $batch->id, auth()->user()->id);
                
                if(!$canAttempt){
                    // Inserting in the exam result as first attempt
                    $canAttempt = (new ExamResult())->saveData(['exam_id' => $exam->id, 'exam_type' => $exam_type, 'batch_id' => $batch->id, 'student_id' => auth()->user()->id, 'gain_marks' => 0, 'status' => 0]);
                }

                // serve exam if the student hasn't completed and submitted an exam. Else, serve pending message/exam result.
                if ( $canAttempt->status == 0 ) {
                    $questions = AptitudeTestMCQ::where('exam_id', $exam->id)->inRandomOrder()->take($exam->question_limit)->get();

                    if($questions->count() < $exam->question_limit){
                        return redirect()->back()->withErrors([ 'not_enough_questions' => 'Question Count is less than question limit !! Please contact admin and notify.' ]);
                    }

                    return view('student.pages_new.batch.exam.batch_exam_aptitude_test', compact('questions', 'exam', 'batch'));
                }
                else{
                    $total_marks = 0;
                    $detailsResults = DetailsResult::where('student_id', auth()->user()->id)
                        ->where('exam_id', $exam->id)
                        ->where('batch_id', $batch->id)
                        ->with('atQuestion')
                        ->get();
            
                    $max = ExamResult::where('exam_id', $exam->id)
                        ->where('batch_id', $batch->id)
                        ->max('gain_marks');
            
                    $min = ExamResult::where('exam_id', $exam->id)
                        ->where('batch_id', $batch->id)
                        ->min('gain_marks');
    
                    $analysis = DetailsResult::join('question_content_tags', 'details_results.question_id', 'question_content_tags.question_id')
                    ->join('content_tags', 'content_tags.id', 'question_content_tags.content_tag_id')
                    ->where('question_content_tags.exam_type', "MCQ")
                    ->where('details_results.student_id', auth()->user()->id)
                    ->where('details_results.batch_id', $batch->id)
                    ->where('details_results.exam_id', $exam->id)
                    ->select('question_content_tags.*', 'details_results.*', 'content_tags.title as contentTag')
                    ->get();
    
                    $weakAnalysis = $analysis;

                    // get next pop quiz
                    $next_exam = Exam::where('exam_type', "Pop Quiz")
                                        ->where('course_id', $course->id)->where('topic_id', $course_topic->id)
                                        ->select('id', 'slug', 'course_id', 'topic_id', 'exam_type', 'order')
                                        ->orderBy('order')
                                        ->with(['course_lectures' => function($query){
                                                return $query->select('id', 'slug', 'course_id', 'topic_id', 'exam_id')->where('status', 1);
                                            },
                                        ])
                                        ->first();

                    if(empty($next_exam->course_lectures[0])){
                        $next_link = route('batch-test', [$course_topic->slug, $batch->slug, $next_exam->id, $next_exam->exam_type]);
                    }
                    else{
                        $next_link = route('topic_lecture', [$batch->slug, $next_exam->course_lectures[0]]);
                    }
                
                    return view('student.pages_new.batch.exam.canAttemp',
                                compact('canAttempt',
                                        'exam',
                                        'batch',
                                        'detailsResults',
                                        'analysis',
                                        'weakAnalysis',
                                        'max',
                                        'min',
                                        'course_topic',
                                        'batch',
                                        'exam',
                                        'next_link'
                                    ));
                }
        }

        if ($exam_type == Edvanture::TOPICENDEXAM) {

            $exam = Exam::where('id', $exam_id)->where('exam_type', $exam_type)->where('topic_id', $course_topic->id)->with([
                'topicEndExamCreativeQuestions.question' => function($query) {
                    return $query->has('detailsResult');
                },
                'topicEndExamCreativeQuestions.question.detailsResult' => function($query) use ($batch) {
                    return $query->where('batch_id', $batch->id)->where('student_id', auth()->user()->id)->where('exam_type', 'Topic End Exam');
                },
                'topicEndExamCreativeQuestions.exam_papers' => function($query) use ($batch) {
                    return $query->where('batch_id', $batch->id)->where('student_id', auth()->user()->id);
                }
                ])
                ->firstOrFail();

            // dd($exam);

            // if CQ exam result exists and is checked, then the user has attended exam and is checked. Then paper+marks+analytics is shown
            $cq_exam_result = ExamResult::where('exam_id', $exam->id)
            ->where('batch_id', $batch->id)
            ->where('student_id', auth()->user()->id)
            ->where('exam_type', 'Topic End Exam CQ')
            ->first();

            // if CQ exam result exists and is checked, then the user has attended exam and is checked. Then paper+marks+analytics is shown
            $mcq_exam_result = ExamResult::where('exam_id', $exam->id)
            ->where('batch_id', $batch->id)
            ->where('student_id', auth()->user()->id)
            ->where('exam_type', 'Topic End Exam MCQ')
            ->first();

            if($mcq_exam_result){
                // contains only details of MCQ exams
                $mcq_details_results = DetailsResult::where('exam_id', $exam->id)
                ->where('batch_id', $batch->id)
                ->where('student_id', auth()->user()->id)
                ->where('exam_type', 'Topic End Exam')
                ->whereNotNull('mcq_ans')
                ->with('topicEndExamMCQ')
                ->get();

                // Count total MCQ marks
                $mcq_total_marks = $mcq_details_results->count();
                $mcq_marks_scored = 0;

                // calculate total marks for MCQ part.
                foreach($mcq_details_results as $details){
                    $mcq_marks_scored += $details->gain_marks;
                }

                // analysis for MCQs
                $all_analysis_mcqs = DetailsResult::join('topic_end_exam_mcqs', 'details_results.question_id', '=', 'topic_end_exam_mcqs.id')
                ->select('details_results.*', 'topic_end_exam_mcqs.*')
                ->where('details_results.exam_id', $exam->id)
                ->where('details_results.exam_type', 'Topic End Exam')
                ->whereNotNull('details_results.mcq_ans')
                ->get();
                
                $mcq_attempts = collect();
                $mcq_corrects = collect();
                foreach($all_analysis_mcqs as $analysis_mcq){
                    if($mcq_attempts->has($analysis_mcq->question_id)){
                        $current_value = $mcq_attempts[$analysis_mcq->question_id];
                        $current_value++;
                        $mcq_attempts->pull($analysis_mcq->question_id);
                        $mcq_attempts->put($analysis_mcq->question_id, $current_value);
                    }
                    else{
                        $mcq_attempts->put($analysis_mcq->question_id, 1);
                    }

                    if($mcq_corrects->has($analysis_mcq->question_id)){
                        if($analysis_mcq->mcq_ans == $analysis_mcq->answer){
                            $current_value = $mcq_corrects[$analysis_mcq->question_id];
                            $current_value++;
                            $mcq_corrects->pull($analysis_mcq->question_id);
                            $mcq_corrects->put($analysis_mcq->question_id, $current_value);
                        }
                    }
                    else{
                        if($analysis_mcq->mcq_ans == $analysis_mcq->answer){
                            $mcq_corrects->put($analysis_mcq->question_id, 1);
                        }
                        else{
                            $mcq_corrects->put($analysis_mcq->question_id, 0);
                        }
                    }
                }

                $mcq_percents = collect();
                foreach($mcq_attempts as $key => $mcq_attempt){
                    $mcq_percents->put($key, round(($mcq_corrects[$key]/$mcq_attempt), 2)*100);
                }

                foreach($mcq_details_results as $mcq_details_result){
                    $mcq_details_result->success_percent = $mcq_percents[$mcq_details_result->question_id];
                }

                $total_mcqs = 0;
                $total_right_ans_for_mcqs = 0;
                foreach($all_analysis_mcqs as $analysis_mcq){
                    $total_mcqs += 1;
                    if($analysis_mcq->mcq_ans == $analysis_mcq->topicEndExamMCQ->answer)
                        $total_right_ans_for_mcqs += 1;
                }
                // End of analysis for MCQs
                $mcqs_exist = true;
            }
            else{
                // No MCQ exists
                $mcqs_exist = false;
                $mcq_details_results = 0;
                $mcq_total_marks = 0;
                $mcq_marks_scored = 0;
                $total_mcqs = 0;
                $total_right_ans_for_mcqs = 0;
            }
            
            if($cq_exam_result){
                if($cq_exam_result->checked == 0) {
                    // Paper Checking Pending
                    return view('student.pages_new.batch.exam.batch_exam_not_checked', compact('batch', 'exam'));
                }
                elseif($cq_exam_result->checked == 1) {

                    $cq_total_marks = 0;
                    foreach($exam->topicEndExamCreativeQuestions as $creative_question){
                        if($creative_question->exam_papers){
                            $cq_total_marks += 10;
                        }
                    }

                    $cq_marks_scored = $cq_exam_result->gain_marks;

                    // analysis for CQs
                    $all_analysis_cqs = TopicEndExamCreativeQuestion::where('exam_id', $exam->id)
                    ->with(['question.allDetailsResult' => function($query){
                        $query->where('exam_type', "Topic End Exam");
                    }])
                    ->get();

                    foreach($all_analysis_cqs as $cq){
                        foreach($cq->question as $cq_ques){
                            // dd($cq_ques);
                            $total_marks = 0;
                            $scored_marks = 0;
                            foreach($cq_ques->allDetailsResult as $result){
                                $total_marks += $cq_ques->marks;
                                $scored_marks += $result->gain_marks;
                            }

                            $cq_ques->avg_score = $total_marks > 0 ? round( (($scored_marks/$total_marks)*$cq_ques->marks), 2) : 0;

                            foreach($exam->topicEndExamCreativeQuestions as $cq){
                                foreach($cq->question as $question){
                                    if($cq_ques->id == $question->id){
                                        $question->avg_score = $total_marks > 0 ? round( (($scored_marks/$total_marks)*$cq_ques->marks), 2) : 0;
                                    }
                                }
                            }
                        }
                    }
                    // End of analysis for CQs
                    $cqs_exist = true;
                }
            }
            else{
                // No CQ exists;
                $cqs_exist = false;
                $cq_total_marks = 0;
                $cq_marks_scored = 0;
            }

            if($mcq_exam_result || ($cq_exam_result && $cq_exam_result->checked == 1)){
                return view('student.pages_new.batch.exam.batch_exam_mcq_plus_cq_topic_end_exam_result',
                compact(
                    'exam',
                    'course_topic',
                    'batch',
                    'mcqs_exist',
                    'mcq_details_results',
                    'mcq_total_marks',
                    'mcq_marks_scored',
                    'total_mcqs',
                    'total_right_ans_for_mcqs',
                    'cqs_exist',
                    'cq_total_marks',
                    'cq_marks_scored',
                ));
            }

            if(!$mcq_exam_result && !$cq_exam_result){
                // If no results exist, then go ahead attempt exam
                $exam = Exam::where('id', $exam_id)->where('exam_type', $exam_type)->where('topic_id', $course_topic->id)->has('batchExam')->first();

                if($exam == null){
                    return redirect()->back()->withErrors([ 'not_added_to_batch' => 'This Quiz has not been added to this batch. Please contact admin and notify.' ]);
                }

                $canAttempt = TopicEndExamCqExamPaper::where('exam_id', $exam->id)
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

                //Giving access to student if they miss for first time or reload page
                if (!$canAttempt) {
                    // get the specified number of questions before serving them as exam
                    $mcq_questions = TopicEndExamMCQ::where('exam_id', $exam->id)->inRandomOrder()->take($exam->question_limit)->get();
                    $cq_questions = TopicEndExamCreativeQuestion::where('exam_id', $exam->id)->inRandomOrder()->take($exam->question_limit_2)->get();

                    if($mcq_questions->count() < $exam->question_limit || $cq_questions->count() < $exam->question_limit_2){
                        return redirect()->back()->withErrors([ 'not_enough_questions' => 'Question Count is less than question limit !! Please contact admin and notify.' ]);
                    }

                    return view('student.pages_new.batch.exam.batch_exam_cq_plus_mcq', compact('mcq_questions', 'cq_questions', 'exam', 'batch'));
                }
            }
        }

        if ($exam_type == Edvanture::POPQUIZ) {

                $exam = Exam::where('id', $exam_id)->where('exam_type', $exam_type)->where('topic_id', $course_topic->id)->with([
                    'popQuizCreativeQuestions.question' => function($query) {
                        return $query->has('detailsResult');
                    },
                    'popQuizCreativeQuestions.question.detailsResult' => function($query) use ($batch) {
                        return $query->where('batch_id', $batch->id)->where('student_id', auth()->user()->id)->where('exam_type', 'Pop Quiz');
                    },
                    'popQuizCreativeQuestions.exam_papers' => function($query) use ($batch) {
                        return $query->where('batch_id', $batch->id)->where('student_id', auth()->user()->id);
                    },
                    ])
                    ->firstOrFail();

                // if CQ exam result exists and is checked, then the user has attended exam and is checked. Then paper+marks+analytics is shown
                $cq_exam_result = ExamResult::where('exam_id', $exam->id)
                ->where('batch_id', $batch->id)
                ->where('student_id', auth()->user()->id)
                ->where('exam_type', 'Pop Quiz CQ')
                ->first();

                $mcq_exam_result = ExamResult::where('exam_id', $exam->id)
                ->where('batch_id', $batch->id)
                ->where('student_id', auth()->user()->id)
                ->where('exam_type', 'Pop Quiz MCQ')
                ->first();

                // Get Next Pop Quiz for link generation
                $next_exam = Exam::where(function ($query)use($exam){
                    $query->where('exam_type', 'Pop Quiz')->orderBy('order')->where('order', '>', $exam->order);
                })
                // ->where('order', '>', $exam->order)
                ->where('course_id', $exam->course_id)
                ->where('topic_id', $exam->topic_id)
                ->with([
                    'course_lectures' => function($query){
                        return $query->select('id', 'slug', 'course_id', 'topic_id', 'exam_id');
                    },
                ])
                ->select('id', 'slug', 'course_id', 'topic_id', 'exam_type')
                ->first();

                // if next pop quiz is not found, get topic end exam
                if(empty($next_exam)){
                    $next_exam = Exam::where(function ($query)use($exam){
                        $query->where('exam_type', 'Topic End Exam');
                    })
                    // ->where('order', '>', $exam->order)
                    ->where('course_id', $exam->course_id)
                    ->where('topic_id', $exam->topic_id)
                    ->with([
                        'course_lectures' => function($query){
                            return $query->select('id', 'slug', 'course_id', 'topic_id', 'exam_id');
                        },
                    ])
                    ->select('id', 'slug', 'course_id', 'topic_id', 'exam_type')
                    ->first();
                }

                // If next pop quiz has lecture, then generate link for that
                if(count($next_exam->course_lectures) > 0){
                    $next_link = route('topic_lecture', [$batch->slug, $next_exam->course_lectures[0]->slug]);
                }
                // else generate link for the quiz
                else{
                    $next_link = route('batch-test', [$course_topic->slug, $batch->slug, $next_exam->id, $next_exam->exam_type]);
                }

                if($mcq_exam_result){
                    // contains only details of MCQ exams
                    $mcq_details_results = DetailsResult::where('exam_id', $exam->id)
                    ->where('batch_id', $batch->id)
                    ->where('student_id', auth()->user()->id)
                    ->where('exam_type', 'Pop Quiz')
                    ->whereNotNull('mcq_ans')
                    ->with('popQuizMCQ')
                    ->get();

                    // Count total MCQ marks
                    $mcq_total_marks = $mcq_details_results->count();
                    $mcq_marks_scored = 0;

                    // calculate total marks for MCQ part.
                    foreach($mcq_details_results as $details){
                        $mcq_marks_scored += $details->gain_marks;
                    }

                    // analysis for MCQs
                    $all_analysis_mcqs = DetailsResult::join('pop_quiz_mcqs', 'details_results.question_id', '=', 'pop_quiz_mcqs.id')
                    ->select('details_results.*', 'pop_quiz_mcqs.*')
                    ->where('details_results.exam_id', $exam->id)
                    ->where('details_results.exam_type', 'Pop Quiz')
                    ->whereNotNull('details_results.mcq_ans')
                    ->get();
                    
                    $mcq_attempts = collect();
                    $mcq_corrects = collect();
                    foreach($all_analysis_mcqs as $analysis_mcq){
                        if($mcq_attempts->has($analysis_mcq->question_id)){
                            $current_value = $mcq_attempts[$analysis_mcq->question_id];
                            $current_value++;
                            $mcq_attempts->pull($analysis_mcq->question_id);
                            $mcq_attempts->put($analysis_mcq->question_id, $current_value);
                        }
                        else{
                            $mcq_attempts->put($analysis_mcq->question_id, 1);
                        }

                        if($mcq_corrects->has($analysis_mcq->question_id)){
                            if($analysis_mcq->mcq_ans == $analysis_mcq->answer){
                                $current_value = $mcq_corrects[$analysis_mcq->question_id];
                                $current_value++;
                                $mcq_corrects->pull($analysis_mcq->question_id);
                                $mcq_corrects->put($analysis_mcq->question_id, $current_value);
                            }
                        }
                        else{
                            if($analysis_mcq->mcq_ans == $analysis_mcq->answer){
                                $mcq_corrects->put($analysis_mcq->question_id, 1);
                            }
                            else{
                                $mcq_corrects->put($analysis_mcq->question_id, 0);
                            }
                        }
                    }

                    $mcq_percents = collect();
                    foreach($mcq_attempts as $key => $mcq_attempt){
                        $mcq_percents->put($key, round(($mcq_corrects[$key]/$mcq_attempt), 2)*100);
                    }

                    foreach($mcq_details_results as $mcq_details_result){
                        $mcq_details_result->success_percent = $mcq_percents[$mcq_details_result->question_id];
                    }

                    $total_mcqs = 0;
                    $total_right_ans_for_mcqs = 0;
                    foreach($all_analysis_mcqs as $analysis_mcq){
                        $total_mcqs += 1;
                        if($analysis_mcq->mcq_ans == $analysis_mcq->popQuizMCQ->answer)
                            $total_right_ans_for_mcqs += 1;
                    }
                    // End of analysis for MCQs
                    $mcqs_exist = true;
                }
                else{
                    // No MCQ exists
                    $mcqs_exist = false;
                    $mcq_details_results = 0;
                    $mcq_total_marks = 0;
                    $mcq_marks_scored = 0;
                    $total_mcqs = 0;
                    $total_right_ans_for_mcqs = 0;
                }
                
                if($cq_exam_result){
                    if($cq_exam_result->checked == 0) {
                        // Paper Checking Pending
                        return view('student.pages_new.batch.exam.batch_exam_not_checked', compact('batch', 'exam', 'next_link'));
                    }
                    elseif($cq_exam_result->checked == 1) {

                        $cq_total_marks = 0;
                        foreach($exam->popQuizCreativeQuestions as $creative_question){
                            if($creative_question->exam_papers){
                                $cq_total_marks += 10;
                            }
                        }

                        $cq_marks_scored = $cq_exam_result->gain_marks;

                        // analysis for CQs
                        $all_analysis_cqs = PopQuizCreativeQuestion::where('exam_id', $exam->id)
                        ->with([
                            'question.allDetailsResult' => function($query){
                                $query->where('exam_type', "Pop Quiz");
                            }])
                        ->get();

                        foreach($all_analysis_cqs as $cq){
                            foreach($cq->question as $cq_ques){
                                $total_marks = 0;
                                $scored_marks = 0;
                                foreach($cq_ques->allDetailsResult as $result){
                                    $total_marks += $cq_ques->marks;
                                    $scored_marks += $result->gain_marks;
                                }
                                $cq_ques->avg_score = $total_marks > 0 ? round( (($scored_marks/$total_marks)*$cq_ques->marks), 2) : 0;

                                foreach($exam->popQuizCreativeQuestions as $cq){
                                    foreach($cq->question as $question){
                                        if($cq_ques->id == $question->id){
                                            $question->avg_score = $total_marks > 0 ? round( (($scored_marks/$total_marks)*$cq_ques->marks), 2) : 0;
                                        }
                                    }
                                }
                            }
                        }
                        // End of analysis for CQs
                        $cqs_exist = true;
                    }
                }
                else{
                    // No CQ exists
                    $cqs_exist = false;
                    $cq_total_marks = 0;
                    $cq_marks_scored = 0;
                }

                if($mcq_exam_result || ($cq_exam_result && $cq_exam_result->checked == 1)){

                    return view('student.pages_new.batch.exam.batch_exam_mcq_plus_cq_pop_quiz_result',
                    compact(
                        'exam',
                        'course_topic',
                        'batch',
                        'mcqs_exist',
                        'mcq_details_results',
                        'mcq_total_marks',
                        'mcq_marks_scored',
                        'total_mcqs',
                        'total_right_ans_for_mcqs',
                        'cqs_exist',
                        'cq_total_marks',
                        'cq_marks_scored',
                        'next_link'
                    ));
                }

                if(!$mcq_exam_result && !$cq_exam_result){
                    // If no results exist, then go ahead attempt exam
                    $exam = Exam::where('id', $exam_id)->where('exam_type', $exam_type)->where('topic_id', $course_topic->id)->has('batchExam')->first();

                    if($exam == null){
                        return redirect()->back()->withErrors([ 'not_added_to_batch' => 'This Quiz has not been added to this batch. Please contact admin and notify.' ]);
                    }

                    $canAttempt = PopQuizCqExamPaper::where('exam_id', $exam->id)
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

                    //Giving access to student if they miss for first time or reload page
                    if (!$canAttempt) {
                        $mcq_questions = PopQuizMCQ::where('exam_id', $exam->id)->inRandomOrder()->take($exam->question_limit)->get();
                        $cq_questions = PopQuizCreativeQuestion::where('exam_id', $exam->id)->inRandomOrder()->take($exam->question_limit_2)->get();
                        
                        if($mcq_questions->count() < $exam->question_limit || $cq_questions->count() < $exam->question_limit_2){
                            return redirect()->back()->withErrors([ 'not_enough_questions' => 'Question Count is less than question limit !! Please contact admin and notify.' ]);
                        }
                        
                        return view('student.pages_new.batch.exam.batch_exam_cq_plus_mcq', compact('mcq_questions', 'cq_questions', 'exam', 'batch'));
                    }
                }
        }

        return view('student.pages_new.course.preview', compact('batch', 'course', 'accessedDays', 'specialExams', 'exams'));
    }

}
