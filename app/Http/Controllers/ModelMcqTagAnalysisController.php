<?php

namespace App\Http\Controllers;

use App\Models\ExamTag;
use App\Models\ModelExam;
use Illuminate\Http\Request;

class ModelMcqTagAnalysisController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $tag_type = request()->input('type');

        $tags = $this->getAnalysis($user,$tag_type);

        return view('student.pages_new.user.exam-tag-analysis',compact('user','tags','tag_type'));
    }

    public function solutions($tagId)
    {
        $tag = ExamTag::query()->findOrFail($tagId);
        return view('student.pages_new.user.exam-tag-solution',compact('tag'));
    }

    protected function getAnalysis($user, $tag_type = null){
        $tags =  ExamTag::query()->whereHas('modelMcqTagAnalysis', function ($q) use ($user) {
            $q->where('student_id',$user->id);
        })->with(['modelMcqTagAnalysis' => function($q) use ($user) {
            $q->where('student_id',$user->id);
        }])->get();


        foreach($tags as $tag){
            $mcq_tag_total_marks = 0;
            $mcq_tag_scored_marks = 0;
            foreach($tag->modelMcqTagAnalysis as $analysis){
                $mcq_tag_total_marks += 1;
                $mcq_tag_scored_marks += $analysis->gain_marks;
            }
            $tag->tag_scored_marks = $mcq_tag_scored_marks > 0 ? $mcq_tag_scored_marks : 0 ;
            $tag->tag_total_marks = $mcq_tag_total_marks;
            $tag->percentage_scored = $mcq_tag_total_marks > 0 ? round((($tag->tag_scored_marks/$mcq_tag_total_marks)*100), 2) : 'no data';
        }
        if($tag_type == 'weakness') {
            $tags = $tags->sortBy('percentage_scored');
        } elseif($tag_type == 'strength') {
            $tags = $tags->sortByDesc('percentage_scored');
        } else{
            abort(404);
        }

        return $tags;
    }

    public function getAjaxTagAnalysis($topicId)
    {
        $user = auth()->user();

        $tags = $tags =  ExamTag::query()->where('exam_topic_id', $topicId)->whereHas('modelMcqTagAnalysis', function ($q) use ($user) {
            $q->where('student_id',$user->id);
        })->with(['modelMcqTagAnalysis' => function($q) use ($user) {
            $q->where('student_id',$user->id);
        }])->get();


        foreach($tags as $tag){
            $mcq_tag_total_marks = 0;
            $mcq_tag_scored_marks = 0;
            foreach($tag->modelMcqTagAnalysis as $analysis){
                $mcq_tag_total_marks += 1;
                $mcq_tag_scored_marks += $analysis->gain_marks;
            }
            $tag->tag_scored_marks = $mcq_tag_scored_marks > 0 ? $mcq_tag_scored_marks : 0;
            $tag->tag_total_marks = $mcq_tag_total_marks;
            $tag->percentage_scored = $mcq_tag_total_marks > 0 ? round((($tag->tag_scored_marks/$mcq_tag_total_marks)*100), 2) : 'no data';
            unset($tag->modelMcqTagAnalysis);
        }

        return response()->json($tags);
    }

    public function tagAnalysisForAdmin()
    {
        $exams =  ModelExam::query()->has('mcqTotalResult')->get();
        $tags = [];
        $selectedExam = null;
        $studentCount = null;
        if(request()->input('query.exam')) {
             $examId = request()->input('query.exam');
             $tags =  ExamTag::query()->whereHas('modelMcqTagAnalysis', function ($q) use ($examId) {
                $q->where('model_exam_id',$examId);
            })->with('modelMcqTagAnalysis')->get();
             $selectedExam = ModelExam::query()->find($examId);

            foreach($tags as $tag){
                $individual = $this->individual($tag->modelMcqTagAnalysis);
                $tag->accuracy = $individual['accuracy'];
                unset($tag->modelMcqTagAnalysis);

                $studentCount = $individual['student_count'];
            }
        }
        return view('admin.pages.model_exam.exam_tag_analysis.index', compact('exams','tags','selectedExam','studentCount'));
    }

    protected function individual($analysis)
    {
        $singleStudent = [];
        $studentIds = [];
        $totalPercentage = 0;
        foreach ($analysis as $key => $value) {
            if(!in_array($value->student_id,$studentIds)) {
                array_push($studentIds,$value->student_id);
            }
        }
        $student_count = count($studentIds);

        foreach($studentIds as $student){
            $scored_marks = 0;
            $tags = 0;
            foreach ($analysis as $value) {
                if($student == $value->student_id) {
                    $tags += 1;
                    $scored_marks += $value->gain_marks;
                }
            }
            $scored_marks = $scored_marks > 0 ? $scored_marks : 0;
            array_push($singleStudent,[
                'id' => $student,
                'marks' => $scored_marks,
                'tags' => $tags,
                'percentage' => $tags > 0 ? round((($scored_marks/$tags)*100), 2) : 0
            ]);
        }

        foreach ($singleStudent as $data) {
            $totalPercentage += $data['percentage'];
        }

        return [
            'accuracy' => (int) $totalPercentage/$student_count,
            'student_count' => $student_count
        ];
    }
}
