<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

// models
use App\Models\Admin\Course;
use App\Models\Admin\BatchLecture;
use App\Models\Student\exam\DetailsResult;
use App\Models\Admin\CompletedLectures;

class ProceedGuard
{
    public function handle(Request $request, Closure $next)
    {
        // dd($request->route('batch'));
        $batch = $request->route('batch');

        $course = Course::where('id', $batch->course_id)->first();

        $batchTopics = BatchLecture::with(['courseTopic.exams' => function($query){
            return $query->where('exam_type', 'Aptitude Test')->orWhere('exam_type', 'Pop Quiz')->orWhere('exam_type', 'Topic End Exam')->orderBy('exam_type')->orderBy('order');
        }, 'courseTopic.exams.course_lectures'])
            ->where('batch_id', $batch->id)
            ->where('course_id', $course->id)
            ->get();

        // $topics = [];
        foreach($batchTopics as $batchTopic){
            foreach($batchTopic->courseTopic->exams as $exam){
                $scored_marks = 0;
                // $details_results = DetailsResult::where('exam_id', $exam->id)->where('student_id', auth()->user()->id)->get();
                $details_results = DetailsResult::where('exam_id', $exam->id)->where('exam_type', $exam->exam_type)->where('student_id', auth()->user()->id)->get();

                if($exam->exam_type === "Aptitude Test" ){
                    if(count($details_results)){
                        $exam->has_been_attempted = true;
                    }
                    else{
                        $exam->has_been_attempted = false;
                    }
                }
                
                foreach($details_results as $details_result){
                    $scored_marks = $scored_marks + $details_result->gain_marks;
                }
                    if($scored_marks >= $exam->threshold_marks){
                        $exam->test_passed = true;
                    }
                    else{
                        $exam->test_passed = false;
                    }

                $lectures_in_this_exam = count($exam->course_lectures);
                $completed_lecture_count = 0;
                foreach($exam->course_lectures as $lecture){
                    $completed = CompletedLectures::where('student_id', auth()->user()->id)->where('lecture_id', $lecture->id)->count();
                    if($completed){
                        $lecture->completed = true;
                        $completed_lecture_count++;
                    }
                    else
                        $lecture->completed = false;
                }
                $exam->lecture_count = $lectures_in_this_exam;
                $exam->completed_lecture_count = $completed_lecture_count;
                $exam->scored_marks = $scored_marks;
            }
        }

        $disabled = false;
        $disabled2 = false;
        foreach ($batchTopics as $batchTopic) {
            if ($disabled && !$disabled2) $disabled = false;
            foreach ($batchTopic->courseTopic->exams as $exam) {
                if (count($exam->course_lectures)) {
                    foreach ($exam->course_lectures as $course_lecture) {
                        if (!$disabled2 && $request->route('courseLecture') && $course_lecture->id == $request->route('courseLecture')->id) return $next($request);
                        elseif ($exam->exam_type == 'Topic End Exam' && !$exam->test_passed) $disabled2 = true;
                        elseif ($disabled && !$disabled2 && !$course_lecture->completed) {
                            $disabled2 = true;
                        } elseif ($disabled2) {
                            abort(403);
                        }
                    }
                }
                
                if (!$disabled2 && $request->route('exam_id') && $exam->id == $request->route('exam_id')) return $next($request);
                elseif ($exam->exam_type === "Aptitude Test" && !$exam->has_been_attempted) {
                    $disabled = true;
                    $disabled2 = true;
                } elseif ($exam->exam_type === "Aptitude Test" && !$exam->test_passed) $disabled = true;
                elseif ($exam->exam_type == 'Topic End Exam' && !$exam->test_passed) $disabled2 = true;
                elseif ($disabled && !$disabled2 && !$exam->test_passed) $disabled2 = true;
                elseif ($disabled2) abort(403);
            }
        }

        return $next($request);
    }
}
