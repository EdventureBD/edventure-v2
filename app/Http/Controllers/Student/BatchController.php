<?php

namespace App\Http\Controllers\Student;

use App\Models\Admin\Batch;
use App\Models\Admin\Course;
use App\Models\Admin\BatchExam;
use App\Models\Admin\LiveClass;
use App\Models\Admin\BatchLecture;
use App\Models\Admin\CourseLecture;
use App\Http\Controllers\Controller;
use App\Models\Admin\BatchStudentEnrollment;
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
        $sExams = [];
        $course = Course::where('id', $batch->course_id)->first();
        // $batchTopics = BatchLecture::with('course_topics', 'batch_lectures.topic_id', 'course_topics.id')
        //     ->where('batch_id', $batch->id)
        //     ->where('course_id', $course->id)
        //     ->get();
        $batchTopics = BatchLecture::with('courseTopic', 'courseTopic.CourseLecture')
            ->where('batch_id', $batch->id)
            ->where('course_id', $course->id)
            ->get();
        // dd($batchTopics);
        $accessedDays = BatchStudentEnrollment::where('student_id', auth()->user()->id)
            ->where('batch_id', $batch->id)
            ->where('course_id', $course->id)
            ->first();
            // dd($accessedDays);
        if ($accessedDays->status == 0) {
            return redirect()->route('course-preview', $course->slug);
        }

        list($exams, $specialExams) = (new BatchExam())->getBatchExams($batch->id);

        // $courseLectures = CourseLecture::where('topic_id', $batchTopics)->get();
        // dd($specialExams);
        // foreach ($specialExams as $specialExam) {
        //     if ($specialExam->exam->special) {
        //         array_push($sExams, $specialExam->exam->id);
        //     }
        // }

        // $specialExams = BatchExam::with('cqExamPaper', 'examResult')->where('batch_id', $batch->id)
        //     ->whereIn('exam_id', $sExams)
        //     ->where('status', '1')
        //     ->get();
        return view('student.pages_new.course.preview', compact('batch', 'course', 'batchTopics', 'accessedDays', 'specialExams', 'exams'));
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
}
