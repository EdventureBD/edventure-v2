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
use App\Models\Admin\AptitudeTestMCQ;
use App\Models\Admin\PopQuizCQ;
use App\Models\Admin\PopQuizCreativeQuestion;
use App\Models\Admin\PopQuizMCQ;
use App\Models\Admin\QuestionContentTag;
use App\Models\Admin\TopicEndExamCQ;
use App\Models\Admin\TopicEndExamCreativeQuestion;
use App\Models\Admin\TopicEndExamMCQ;
use App\Models\Student\exam\QuestionContentTagAnalysis;
use Maatwebsite\Excel\Facades\Excel;

class ExamController extends Controller
{
    public function index()
    {
        // $exams = Exam::join('courses', 'exams.course_id', 'courses.id')
        //     ->join('course_topics', 'exams.topic_id', 'course_topics.id')
        //     ->select('exams.*', 'courses.title as courseName', 'course_topics.title as topicName')
        //     ->orderby('id', 'DESC')->get();

        $exams = Exam::query()->with('course')->with('topic')->get();
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
        if($exam->exam_type == "Aptitude Test"){
            $mcq_questions = AptitudeTestMCQ::where('exam_id', $exam->id)->get();
            foreach($mcq_questions as $mcq){
                $question_content_tags = QuestionContentTag::where('question_id', $mcq->id)->where('exam_type', $exam->exam_type)->get();
                foreach($question_content_tags as $tag){
                    $question_content_tag_analysis = QuestionContentTagAnalysis::where('question_id', $mcq->id)->where('exam_type', $exam->exam_type)->get();
                    foreach($question_content_tag_analysis as $tag_analysis){
                        $tag_analysis->delete();
                    }
                    $tag->delete();
                }
                $mcq->delete();
            }
        }
        elseif($exam->exam_type == "Pop Quiz"){
            $mcq_questions = PopQuizMCQ::where('exam_id', $exam->id)->get();
            foreach($mcq_questions as $mcq){
                $mcq_question_content_tags = QuestionContentTag::where('question_id', $mcq->id)->where('exam_type', 'LIKE', $exam->exam_type.' MCQ')->get();
                foreach($mcq_question_content_tags as $tag){
                    $mcq_question_content_tag_analysis = QuestionContentTagAnalysis::where('question_id', $mcq->id)->where('exam_type', 'LIKE', $exam->exam_type.' MCQ')->get();
                    foreach($mcq_question_content_tag_analysis as $tag_analysis){
                        $tag_analysis->delete();
                    }
                    $tag->delete();
                }
                $mcq->delete();
            }

            $creative_questions = PopQuizCreativeQuestion::where('exam_id', $exam->id)->get();
            foreach($creative_questions as $creative_question){
                $cqs = PopQuizCQ::where('creative_question_id', $creative_question->id)->get();
                foreach($cqs as $cq){
                    $cq_question_content_tags = QuestionContentTag::where('question_id', $cq->id)->where('exam_type', 'LIKE', $exam->exam_type.' CQ')->get();
                    foreach($cq_question_content_tags as $tag){
                        $cq_question_content_tag_analysis = QuestionContentTagAnalysis::where('question_id', $cq->id)->where('exam_type', 'LIKE', $exam->exam_type.' CQ')->get();
                        foreach($cq_question_content_tag_analysis as $tag_analysis){
                            $tag_analysis->delete();
                        }
                        $tag->delete();
                    }
                    $cq->delete();
                }
                $creative_question->delete();
            }
        }
        elseif($exam->exam_type == "Topic End Exam"){
            $mcq_questions = TopicEndExamMCQ::where('exam_id', $exam->id)->get();
            foreach($mcq_questions as $mcq){
                $question_content_tags = QuestionContentTag::where('question_id', $mcq->id)->where('exam_type', 'LIKE', $exam->exam_type.' MCQ')->get();
                foreach($question_content_tags as $tag){
                    $question_content_tag_analysis = QuestionContentTagAnalysis::where('question_id', $mcq->id)->where('exam_type', 'LIKE', $exam->exam_type.' MCQ')->get();
                    foreach($question_content_tag_analysis as $tag_analysis){
                        $tag_analysis->delete();
                    }
                    $tag->delete();
                }
                $mcq->delete();
            }

            $creative_questions = TopicEndExamCreativeQuestion::where('exam_id', $exam->id)->get();
            foreach($creative_questions as $creative_question){
                $cqs = TopicEndExamCQ::where('creative_question_id', $creative_question->id)->get();
                foreach($cqs as $cq){
                    $cq_question_content_tags = QuestionContentTag::where('question_id', $cq->id)->where('exam_type', 'LIKE', $exam->exam_type.' CQ')->get();
                    foreach($cq_question_content_tags as $tag){
                        $cq_question_content_tag_analysis = QuestionContentTagAnalysis::where('question_id', $cq->id)->where('exam_type', 'LIKE', $exam->exam_type.' CQ')->get();
                        foreach($cq_question_content_tag_analysis as $tag_analysis){
                            $tag_analysis->delete();
                        }
                        $tag->delete();
                    }
                    $cq->delete();
                }
                $creative_question->delete();
            }
        }

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
            $store_route = 'pop-quiz-cq.store';
            $type = 'Pop Quiz';
        } elseif (($exam->exam_type) == 'Topic End Exam') {
            $store_route = 'topic-end-exam-cq.store';
            $type = 'Topic End Exam';
        }

        return view('admin.pages.mcq_and_cq.create_cq', compact('exam', 'contentTags', 'store_route', 'type'));
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
            $store_route = 'pop-quiz-mcq.store';
            $type = 'Pop Quiz';
        } elseif (($exam->exam_type) == 'Topic End Exam') {
            $store_route = 'topic-end-exam-mcq.store';
            $type = 'Topic End Exam';
        }

        return view('admin.pages.mcq_and_cq.create_mcq', compact('exam', 'contentTags', 'store_route', 'type'));
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
        }
        elseif ($exam->exam_type == 'CQ') {
            // $cqs = CQ::join('exams', 'c_q_s.exam_id', 'exams.id')
            //     ->select('c_q_s.*', 'exams.title as examTitle')
            //     ->where('exam_id', $exam->id)
            //     ->orderby('id', 'DESC')->get();
            // return view('admin.pages.cq.index', compact('exam', 'cqs'));
            return redirect()->route('cq.index', [$exam]);
        }
        elseif ($exam->exam_type == 'Assignment') {
            // $assignments = Assignment::join('exams', 'assignments.exam_id', 'exams.id')
            //     ->select('assignments.*', 'exams.title as examTitle')
            //     ->where('exam_id', $exam->id)
            //     ->orderby('id', 'DESC')->get();
            // return view('admin.pages.assignment.index', compact('exam', 'assignments'));
            return redirect()->route('assignment.index', [$exam]);
        }
        elseif ($exam->exam_type == 'Aptitude Test') {
            return redirect()->route('aptitude-test-mcqs.index', [$exam]);
        }
        elseif ($exam->exam_type == 'Pop Quiz') {
            return redirect()->route('pop-quiz-all', [$exam]);
        }
        elseif ($exam->exam_type == 'Topic End Exam') {
            return redirect()->route('topic-end-exam-all', [$exam]);
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

        $exams = Exam::where('exam_type', $examType)->orderby('id', 'DESC')->get();
        return view('admin.pages.exam.index', compact('exams'));
    }
}
