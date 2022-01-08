<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\CQ;
use App\Models\Admin\MCQ;
use App\Models\Admin\Exam;
use Illuminate\Http\Request;
use App\Imports\QuestionImport;
use App\Models\Admin\Assignment;
use App\Models\Admin\ContentTag;
use App\Imports\CQQuestionImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExamController extends Controller
{
    public function index()
    {
        // $exams = Exam::join('courses', 'exams.course_id', 'courses.id')
        //     ->join('course_topics', 'exams.topic_id', 'course_topics.id')
        //     ->select('exams.*', 'courses.title as courseName', 'course_topics.title as topicName')
        //     ->orderby('id', 'DESC')->get();

        $exams = Exam::all();
        return view('admin.pages.exam.index', compact('exams'));
    }

    public function create()
    {
        return view('admin.pages.exam.create');
    }

    public function show(Exam $exam)
    {
        return $this->view($exam);
    }

    public function edit(Exam $exam)
    {
        return view('admin.pages.exam.edit', compact('exam'));
    }

    public function destroy(Exam $exam)
    {
        $delete = $exam->delete();
        if ($delete) {
            return redirect()->route('exam.index')->with('status', 'Exam successfully deleted!');
        } else {
            return redirect()->route('exam.index')->with('failed', 'Exam deletion failed!');
        }
    }

    public function addQuestion(Exam $exam)
    {
        if ($exam->special) {
            $contentTags = ContentTag::where('course_id', $exam->course_id)
                ->get();
        } else {
            $contentTags = ContentTag::where('course_id', $exam->course_id)
                ->where('topic_id', $exam->topic_id)
                ->get();
        }

        if (($exam->exam_type) == 'MCQ') {
            return view('admin.pages.mcq.create', compact('exam', 'contentTags'));
        } elseif (($exam->exam_type) == 'CQ') {
            return view('admin.pages.cq.create', compact('exam', 'contentTags'));
        } elseif (($exam->exam_type) == 'Assignment') {
            return view('admin.pages.assignment.create', compact('exam'));
        } elseif (($exam->exam_type) == 'Aptitude Test') {
            return view('admin.pages.aptitude_test.create', compact('exam', 'contentTags'));
        }
        
        // elseif (($exam->exam_type) == 'Pop Quiz') {

        //     // dd("HIT");

        //     return view('admin.pages.pop_quiz.create_MCQ', compact('exam', 'contentTags'));
        // }elseif (($exam->exam_type) == 'Topic End Exam') {
        //     return view('admin.pages.topic_end_exam.create', compact('exam', 'contentTags'));
        // }
    }

    public function addQuestion_CQ_only(Exam $exam)
    {
        if ($exam->special) {
            $contentTags = ContentTag::where('course_id', $exam->course_id)
                ->get();
        } else {
            $contentTags = ContentTag::where('course_id', $exam->course_id)
                ->where('topic_id', $exam->topic_id)
                ->get();
        }

        if (($exam->exam_type) == 'Pop Quiz') {
            dd($exam, "Pop Quiz CQ only");
            return view('admin.pages.mcq_and_cq.create_cq', compact('exam', 'contentTags'));
        } elseif (($exam->exam_type) == 'Topic End Exam') {
            dd($exam, "Topic End Exam CQ only");
            return view('admin.pages.mcq_and_cq.create_cq', compact('exam', 'contentTags'));
        }

        dd("Missed LOL !!");
        
        // elseif (($exam->exam_type) == 'Pop Quiz') {

        //     // dd("HIT");

        //     return view('admin.pages.pop_quiz.create_MCQ', compact('exam', 'contentTags'));
        // }elseif (($exam->exam_type) == 'Topic End Exam') {
        //     return view('admin.pages.topic_end_exam.create', compact('exam', 'contentTags'));
        // }
    }

    public function addQuestion_MCQ_only(Exam $exam)
    {
        if ($exam->special) {
            $contentTags = ContentTag::where('course_id', $exam->course_id)
                ->get();
        } else {
            $contentTags = ContentTag::where('course_id', $exam->course_id)
                ->where('topic_id', $exam->topic_id)
                ->get();
        }

        if (($exam->exam_type) == 'Pop Quiz') {
            // dd($exam->exam_type, "Pop Quiz MCQ only");
            return view('admin.pages.mcq_and_cq.create_mcq', compact('exam', 'contentTags'));
        } elseif (($exam->exam_type) == 'Topic End Exam') {
            dd($exam->exam_type, "Topic End Exam MCQ only");
            return view('admin.pages.mcq_and_cq.create_mcq', compact('exam', 'contentTags'));
        }

        dd("Missed LOL !!");
        
        // elseif (($exam->exam_type) == 'Pop Quiz') {

        //     // dd("HIT");

        //     return view('admin.pages.pop_quiz.create_MCQ', compact('exam', 'contentTags'));
        // }elseif (($exam->exam_type) == 'Topic End Exam') {
        //     return view('admin.pages.topic_end_exam.create', compact('exam', 'contentTags'));
        // }
    }

    public function excelAddQuestion(Exam $exam, Request $request)
    {
        if ($exam->exam_type == 'MCQ') {
            $excel = Excel::import(new QuestionImport($exam), $request->file('file'));
            if ($excel) {
                return $this->view($exam);
            }
        } elseif ($exam->exam_type == 'CQ') {
            $excel = Excel::import(new CQQuestionImport($exam), $request->file('file'));
            if ($excel) {
                return $this->view($exam);
            }
        } elseif ($exam->exam_type == 'Assignment') {
            $excel = Excel::import(new CQQuestionImport($exam), $request->file('file'));
            if ($excel) {
                return $this->view($exam);
            }
        }
    }

    private function view(Exam $exam)
    {
        if ($exam->exam_type == 'MCQ') {
            // $mcqs = MCQ::join('exams', 'm_c_q_s.exam_id', 'exams.id')
            //     ->select('m_c_q_s.*', 'exams.title as examTitle')
            //     ->where('exam_id', $exam->id)
            //     ->orderby('id', 'DESC')->get();
            // return view('admin.pages.mcq.index', compact('exam', 'mcqs'));
            return redirect()->route('mcq.index', [$exam]);
        } elseif ($exam->exam_type == 'CQ') {
            // $cqs = CQ::join('exams', 'c_q_s.exam_id', 'exams.id')
            //     ->select('c_q_s.*', 'exams.title as examTitle')
            //     ->where('exam_id', $exam->id)
            //     ->orderby('id', 'DESC')->get();
            // return view('admin.pages.cq.index', compact('exam', 'cqs'));
            return redirect()->route('cq.index', [$exam]);
        } elseif ($exam->exam_type == 'Assignment') {
            // $assignments = Assignment::join('exams', 'assignments.exam_id', 'exams.id')
            //     ->select('assignments.*', 'exams.title as examTitle')
            //     ->where('exam_id', $exam->id)
            //     ->orderby('id', 'DESC')->get();
            // return view('admin.pages.assignment.index', compact('exam', 'assignments'));
            return redirect()->route('assignment.index', [$exam]);
        } elseif ($exam->exam_type == 'Aptitude Test') {
            // $assignments = Assignment::join('exams', 'assignments.exam_id', 'exams.id')
            //     ->select('assignments.*', 'exams.title as examTitle')
            //     ->where('exam_id', $exam->id)
            //     ->orderby('id', 'DESC')->get();
            // return view('admin.pages.assignment.index', compact('exam', 'assignments'));
            // dd("Aptitude Boi");
            return redirect()->route('aptitude-test-mcqs.index', [$exam]);
        } elseif ($exam->exam_type == 'Pop Quiz') {
            // $assignments = Assignment::join('exams', 'assignments.exam_id', 'exams.id')
            //     ->select('assignments.*', 'exams.title as examTitle')
            //     ->where('exam_id', $exam->id)
            //     ->orderby('id', 'DESC')->get();
            // return view('admin.pages.assignment.index', compact('exam', 'assignments'));
            // dd("Pop Quiz Boi in ExamController", $exam);
            return redirect()->route('pop-quiz-mcq.index', [$exam]);
        } elseif ($exam->exam_type == 'Topic End Exam') {
            // $assignments = Assignment::join('exams', 'assignments.exam_id', 'exams.id')
            //     ->select('assignments.*', 'exams.title as examTitle')
            //     ->where('exam_id', $exam->id)
            //     ->orderby('id', 'DESC')->get();
            // return view('admin.pages.assignment.index', compact('exam', 'assignments'));
            dd("Topic End Exam Boi in ExamController");
            return redirect()->route('topic-end-exam.index', [$exam]);
        }
    }

    public function allMCQ()
    {
        return $this->singleExamType("MCQ");
    }

    public function allCQ()
    {
        return $this->singleExamType("CQ");
    }

    public function allAssignment()
    {
        return $this->singleExamType("Assignment");
    }

    public function allAT()
    {
        return $this->singleExamType("Aptitude Test");
    }

    public function allPQ()
    {
        return $this->singleExamType("Pop Quiz");
    }

    public function allTEE()
    {
        return $this->singleExamType("Topic End Exam");
    }

    private function singleExamType($examType)
    {
        // $exams = Exam::join('courses', 'exams.course_id', 'courses.id')
        //     ->join('course_topics', 'exams.topic_id', 'course_topics.id')
        //     ->select('exams.*', 'courses.title as courseName', 'course_topics.title as topicName')
        //     ->where('exams.exam_type', $examType)
        //     ->orderby('id', 'DESC')->get();

        // if($examType == "Pop Quiz" || $examType == "Topic End Exam"){
        //     $exams = Exam::where('exam_type', $examType)->orderby('id', 'DESC')->get();
        //     return view('admin.pages.exam_cq_and_mcq.index', compact('exams'));
        // }
        // else{
        //     // dd("MISS");
        //     // $exams = Exam::where('exam_type', $examType)->orderby('id', 'DESC')->get();
        //     // return view('admin.pages.exam.index', compact('exams'));
        // }

        $exams = Exam::where('exam_type', $examType)->orderby('id', 'DESC')->get();
        return view('admin.pages.exam.index', compact('exams'));
    }
}
