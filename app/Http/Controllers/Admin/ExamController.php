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
        }
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
            $mcqs = MCQ::join('exams', 'm_c_q_s.exam_id', 'exams.id')
                ->select('m_c_q_s.*', 'exams.title as examTitle')
                ->where('exam_id', $exam->id)
                ->orderby('id', 'DESC')->get();
            // return view('admin.pages.mcq.index', compact('exam', 'mcqs'));
            return redirect()->route('mcq.index', [$exam, 'mcqs' => $mcqs]);
        } elseif ($exam->exam_type == 'CQ') {
            $cqs = CQ::join('exams', 'c_q_s.exam_id', 'exams.id')
                ->select('c_q_s.*', 'exams.title as examTitle')
                ->where('exam_id', $exam->id)
                ->orderby('id', 'DESC')->get();
            // return view('admin.pages.cq.index', compact('exam', 'cqs'));
            return redirect()->route('cq.index', [$exam, 'mcqs' => $cqs]);
        } elseif ($exam->exam_type == 'Assignment') {
            $assignments = Assignment::join('exams', 'assignments.exam_id', 'exams.id')
                ->select('assignments.*', 'exams.title as examTitle')
                ->where('exam_id', $exam->id)
                ->orderby('id', 'DESC')->get();
            // return view('admin.pages.assignment.index', compact('exam', 'assignments'));
            return redirect()->route('assignment.index', [$exam, 'mcqs' => $assignments]);
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

    private function singleExamType($examType)
    {
        // $exams = Exam::join('courses', 'exams.course_id', 'courses.id')
        //     ->join('course_topics', 'exams.topic_id', 'course_topics.id')
        //     ->select('exams.*', 'courses.title as courseName', 'course_topics.title as topicName')
        //     ->where('exams.exam_type', $examType)
        //     ->orderby('id', 'DESC')->get();

        $exams = Exam::where('exam_type', $examType)->orderby('id', 'DESC')->get();
        return view('admin.pages.exam.index', compact('exams'));
    }
}
