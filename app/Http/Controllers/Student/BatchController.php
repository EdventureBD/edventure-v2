<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;

use App\Models\Admin\Batch;
use App\Models\Admin\Course;
use App\Models\Admin\Exam;
use App\Models\Admin\BatchExam;
use App\Models\Admin\LiveClass;
use App\Models\Admin\BatchLecture;
use App\Models\Admin\CourseLecture;
use App\Http\Controllers\Controller;
use App\Models\Admin\BatchStudentEnrollment;
use App\Models\Admin\CompletedLectures;
use App\Models\Student\exam\DetailsResult;
use App\Models\Student\exam\ExamResult;
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

    // public function batchLecture(Batch $batch)
    // {
    //     $sExams = [];
    //     $course = Course::where('id', $batch->course_id)->first();
    //     // $batchTopics = BatchLecture::with('course_topics', 'batch_lectures.topic_id', 'course_topics.id')
    //     //     ->where('batch_id', $batch->id)
    //     //     ->where('course_id', $course->id)
    //     //     ->get();
    //     $batchTopics = BatchLecture::with('courseTopic', 'courseTopic.CourseLecture')
    //         ->where('batch_id', $batch->id)
    //         ->where('course_id', $course->id)
    //         ->get();
    //     // dd($batchTopics);
    //     $accessedDays = BatchStudentEnrollment::where('student_id', auth()->user()->id)
    //         ->where('batch_id', $batch->id)
    //         ->where('course_id', $course->id)
    //         ->first();
    //         // dd($accessedDays);
    //     if ($accessedDays->status == 0) {
    //         return redirect()->route('course-preview', $course->slug);
    //     }

    //     list($exams, $specialExams) = (new BatchExam())->getBatchExams($batch->id);

    //     // dd($batch, $course, $batchTopics, $accessedDays, $specialExams, $exams);

    //     // $courseLectures = CourseLecture::where('topic_id', $batchTopics)->get();
    //     // dd($specialExams);
    //     // foreach ($specialExams as $specialExam) {
    //     //     if ($specialExam->exam->special) {
    //     //         array_push($sExams, $specialExam->exam->id);
    //     //     }
    //     // }

    //     // $specialExams = BatchExam::with('cqExamPaper', 'examResult')->where('batch_id', $batch->id)
    //     //     ->whereIn('exam_id', $sExams)
    //     //     ->where('status', '1')
    //     //     ->get();

    //     return view('student.pages_new.course.preview', compact('batch', 'course', 'batchTopics', 'accessedDays', 'specialExams', 'exams'));
    // }

    public function batchLecture(Batch $batch)
    {
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
                $details_results = DetailsResult::where('exam_id', $exam->id)->where('student_id', auth()->user()->id)->get();
                foreach($details_results as $details_result){
                    $scored_marks = $scored_marks + $details_result->gain_marks;
                }
                    if($scored_marks >= $exam->question_limit){
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

        $accessedDays = BatchStudentEnrollment::where('student_id', auth()->user()->id)
            ->where('batch_id', $batch->id)
            ->where('course_id', $course->id)
            ->first();

        // dd(auth()->user()->id, $batch, $course, $batchTopics, $accessedDays);

        return view('student.pages_new.roadmap.roadmap_index', compact('batch', 'course', 'batchTopics', 'accessedDays'));
    }

    // public function batchTests(Batch $batch){
    //     // $sExams = [];
    //     // $course = Course::where('id', $batch->course_id)->first();
    //     // // $batchTopics = BatchLecture::with('course_topics', 'batch_lectures.topic_id', 'course_topics.id')
    //     // //     ->where('batch_id', $batch->id)
    //     // //     ->where('course_id', $course->id)
    //     // //     ->get();
    //     // $batchTopics = BatchLecture::with('courseTopic', 'courseTopic.CourseLecture')
    //     //     ->where('batch_id', $batch->id)
    //     //     ->where('course_id', $course->id)
    //     //     ->get();
    //     // // dd($batchTopics);
    //     // $accessedDays = BatchStudentEnrollment::where('student_id', auth()->user()->id)
    //     //     ->where('batch_id', $batch->id)
    //     //     ->where('course_id', $course->id)
    //     //     ->first();
    //     //     // dd($accessedDays);
    //     // if ($accessedDays->status == 0) {
    //     //     return redirect()->route('course-preview', $course->slug);
    //     // }

    //     list($exams, $specialExams) = (new BatchExam())->getBatchExams($batch->id);

    //     dd($batch, $exams, $specialExams);

    //     return view('student.pages_new.roadmap.roadmap_tests', compact('batch' ,'specialExams', 'exams'));
    // }

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

    public function lecture_visit_confirmed_ajax(Request $request, CourseLecture $courseLecture){

        if($request->ajax()){

            $completed = CompletedLectures::where('student_id', auth()->user()->id)->where('lecture_id', $courseLecture->id)->first();

            if($completed){
                $completed->delete();
            }
            else{
                $completed = new CompletedLectures();
                $completed->student_id = auth()->user()->id;
                $completed->lecture_id = $courseLecture->id;
                $completed->save();
            }
        }
    }
}
