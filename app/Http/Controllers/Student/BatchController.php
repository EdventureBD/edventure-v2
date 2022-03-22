<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;

use App\Models\Admin\Batch;
use App\Models\Admin\Course;
use App\Models\Admin\LiveClass;
use App\Models\Admin\BatchLecture;
use App\Models\Admin\CourseLecture;
use App\Http\Controllers\Controller;
use App\Models\Admin\BatchStudentEnrollment;
use App\Models\Admin\CompletedLectures;
use App\Models\Student\exam\DetailsResult;
use DateTime;

class BatchController extends Controller
{
    public function batch()
    {
        $batches = BatchStudentEnrollment::join('payments', 'payments.id', 'batch_student_enrollments.payment_id')
            ->where('batch_student_enrollments.student_id', auth()->user()->id)
            ->where('payments.student_id', auth()->user()->id)
            ->where('payments.accepted', 1)
            ->get();
        return view('student.pages.batch.index', compact('batches'));
    }

    public function batchLecture(Batch $batch)
    {
        $course = Course::where('id', $batch->course_id)->first();

        $batchTopics = BatchLecture::with(['courseTopic.exams' => function($query){
            return $query->where('exam_type', 'Aptitude Test')->orWhere('exam_type', 'Pop Quiz')->orWhere('exam_type', 'Topic End Exam')->orderBy('exam_type')->orderBy('order');
        }, 'courseTopic.exams.course_lectures'])
            ->where('batch_id', $batch->id)
            ->where('course_id', $course->id)
            ->get();

        $island_images = [];

        $previous_aptitude_test_passed = true;
        $previous_topic_end_exam_passed = true;
        foreach($batchTopics as $key => $batchTopic){

            // nodes can be lectures or courses. Counting how many out of total are completed.
            $number_of_nodes = 0;
            $number_of_completed_nodes = 0;

            // $island_images[] = $batchTopic->courseTopic->island_image;
            foreach($batchTopic->courseTopic->exams as $exam){
                $aptitude_test_passed = $previous_aptitude_test_passed;
                $topic_end_exam_passed = $previous_topic_end_exam_passed;
                
                $number_of_nodes++;
                $scored_marks = 0;
                $details_results = DetailsResult::where('exam_id', $exam->id)->where('exam_type', $exam->exam_type)->where('student_id', auth()->user()->id)->get();

                if($exam->exam_type === "Aptitude Test" || $exam->exam_type === "Pop Quiz"){
                    if(count($details_results)){
                        $number_of_completed_nodes++;
                        $exam->has_been_attempted = true;
                    }
                    else{
                        $exam->has_been_attempted = false;
                    }
                }
                
                $exam->previous_aptitude_test_passed = $previous_aptitude_test_passed;
                $exam->previous_topic_end_exam_passed = $previous_topic_end_exam_passed;

                foreach($details_results as $details_result){
                    $scored_marks = $scored_marks + $details_result->gain_marks;
                }
                
                if($scored_marks >= $exam->threshold_marks){
                    if($exam->exam_type !== "Aptitude Test" ){
                        $number_of_completed_nodes++;
                    }
                    $exam->test_passed = true;
                }
                else{
                    if($exam->exam_type === "Aptitude Test" && $aptitude_test_passed ){
                        $aptitude_test_passed = false;
                    }
                    if($exam->exam_type === "Topic End Exam" && $topic_end_exam_passed){
                        $topic_end_exam_passed = false;
                    }
                    $exam->test_passed = false;
                }

                $lectures_in_this_exam = count($exam->course_lectures);
                $completed_lecture_count = 0;
                foreach($exam->course_lectures as $lecture){
                    $number_of_nodes++;
                    $completed = CompletedLectures::where('student_id', auth()->user()->id)->where('lecture_id', $lecture->id)->count();
                    if($completed){
                        $number_of_completed_nodes++;
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

            // calculate completion percentage using total nodes and completed nodes
            if($number_of_nodes == 0){
                $batchTopic->percentage_completion = 0;
            }
            else{
                $batchTopic->percentage_completion = ($number_of_completed_nodes/$number_of_nodes)*100;
            }

            if($key == 0 || ($previous_topic_end_exam_passed)){
                if($batchTopic->percentage_completion >= 99){
                    $island_images[] = $batchTopic->courseTopic->three_star_island_image;
                }
                elseif($batchTopic->percentage_completion >= 66){
                    $island_images[] = $batchTopic->courseTopic->two_star_island_image;
                }
                elseif($batchTopic->percentage_completion >= 33){
                    $island_images[] = $batchTopic->courseTopic->one_star_island_image;
                }
                elseif($batchTopic->percentage_completion >= 0){
                    $island_images[] = $batchTopic->courseTopic->zero_star_island_image;
                }
            } else {
                $island_images[] = $batchTopic->courseTopic->disabled_island_image;
            }

            $previous_aptitude_test_passed = $aptitude_test_passed;
            $previous_topic_end_exam_passed = $topic_end_exam_passed;
        }

        $accessedDays = BatchStudentEnrollment::where('student_id', auth()->user()->id)
            ->where('batch_id', $batch->id)
            ->where('course_id', $course->id)
            ->first();

        // dd($batchTopics, $island_images);

        return view('student.pages_new.roadmap.new_roadmap_index', compact('batch', 'course', 'batchTopics', 'accessedDays', 'island_images'));
    }

    public function lecture(Batch $batch, CourseLecture $courseLecture)
    {
        //setting next lecture & prev lecture
        $prev_lecture = CourseLecture::where('topic_id', $courseLecture->topic_id)->where('id', '<', $courseLecture->id)->orderBy('created_at', 'desc')->first();
        $prev_lecture_link = $prev_lecture ? route('topic_lecture', [$batch->slug, $prev_lecture->slug]) : null;
        $next_lecture = CourseLecture::where('topic_id', $courseLecture->topic_id)->where('id', '>', $courseLecture->id)->orderBy('created_at', 'asc')->first();
        $next_lecture_link = $next_lecture ? route('topic_lecture', [$batch->slug, $next_lecture->slug]) : null;
        // dd($next_lecture);

        $course = Course::where('id', $batch->course_id)->first();
        $liveClass = LiveClass::where('batch_id', $batch->id)
            // ->where('course_id', $batch->course_id)
            ->where('topic_id', $courseLecture->topic_id)
            ->where('status', 1)
            ->latest()->first();
        $start_date = "";
        $start_time = "";
        $timeleft = 3000;
        if (!empty($liveClass->start_date)) {
            $start_date_time = new DateTime($liveClass->start_date . ' ' . $liveClass->start_time);
            $today_time = new DateTime();
            $timeleft_seconds = $start_date_time->format('U') - $today_time->format('U');
            $timeleft = $timeleft_seconds;
        }
        return view('student.pages_new.batch.specific_lecture', compact('batch', 'courseLecture', 'course', 'liveClass', 'start_date', 'start_time', 'timeleft', 'prev_lecture_link', 'next_lecture_link'));
    }

    public function lecture_visit_confirmed_ajax($batch, $courseLecture){

        $completed = CompletedLectures::where('student_id', auth()->user()->id)->where('lecture_id', $courseLecture)->first();

        if($completed){
            $completed->delete();
        }
        else{
            $completed = new CompletedLectures();
            $completed->student_id = auth()->user()->id;
            $completed->lecture_id = $courseLecture;
            $completed->save();
        }

        return true;
    }

    public function get_lecture_visit_status_ajax($batch, $courseLecture){
        $completed_lecture = CompletedLectures::where('student_id', auth()->user()->id)->where('lecture_id', $courseLecture)->first();
        if($completed_lecture){
            return true;
        }
        else{
            return false;
        }
    }
}
