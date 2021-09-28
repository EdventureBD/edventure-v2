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
        $batchTopics = BatchLecture::join('course_topics', 'batch_lectures.topic_id', 'course_topics.id')
            ->where('batch_lectures.batch_id', $batch->id)
            ->where('batch_lectures.course_id', $course->id)
            ->get();
        $accessedDays = BatchStudentEnrollment::where('student_id', auth()->user()->id)
            ->where('batch_id', $batch->id)
            ->where('course_id', $course->id)
            ->first();

        $specialExams = BatchExam::where('batch_id', $batch->id)
            ->where('status', '1')
            ->get();
        // dd($specialExams);
        foreach ($specialExams as $specialExam) {
            if ($specialExam->exam->special) {
                array_push($sExams, $specialExam->exam->id);
            }
        }

        $specialExams = BatchExam::where('batch_id', $batch->id)
            ->whereIn('exam_id', $sExams)
            ->where('status', '1')
            ->get();
        return view('student.pages.batch.batch_lecture', compact('batch', 'course', 'batchTopics', 'accessedDays', 'specialExams'));
    }

    public function lecture(Batch $batch, CourseLecture $courseLecture)
    {
        // dd($courseLecture);
        // dd($batch);
        $course = Course::where('id', $batch->course_id)->first();
        $liveClass = LiveClass::where('batch_id', $batch->id)
            ->where('course_id', $batch->course_id)
            ->where('topic_id', $courseLecture->topic_id)
            ->where('status', 1)
            ->latest()->first();
        $start_date = "";
        $start_time = "";
        if (!empty($liveClass->start_date) && !is_null($liveClass->start_date)) {
            $start_date = date('m-d-Y', strtotime($liveClass->start_date));
        }
        if (!empty($liveClass->start_time) && !is_null($liveClass->start_time)) {
            $start_time = date('h:m:s', strtotime($liveClass->start_time));
        }


        return view('student.pages.batch.specific_lecture', compact('batch', 'courseLecture', 'course', 'liveClass', 'start_date', 'start_time'));
    }
}
