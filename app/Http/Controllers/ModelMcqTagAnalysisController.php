<?php

namespace App\Http\Controllers;

use App\Models\ExamTag;
use Illuminate\Http\Request;

class ModelMcqTagAnalysisController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $tag_type = request()->input('type');

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
            $tag->tag_scored_marks = $mcq_tag_scored_marks;
            $tag->tag_total_marks = $mcq_tag_total_marks;
            $tag->percentage_scored = $mcq_tag_total_marks > 0 ? round((($mcq_tag_scored_marks/$mcq_tag_total_marks)*100), 2) : 'no data';
        }

        return view('student.pages_new.user.exam-weakness-tag-analysis',compact('user','tags','tag_type'));
    }
}
