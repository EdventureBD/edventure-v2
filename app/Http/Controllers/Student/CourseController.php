<?php

namespace App\Http\Controllers\Student;

use App\Models\Admin\Batch;
use App\Models\Admin\Course;
use Illuminate\Http\Request;
use App\Models\Admin\Payment;
use App\Models\Admin\CourseTopic;
use App\Models\Admin\CourseLecture;
use App\Models\Admin\PaymentNumber;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Student\StudentDetails;
use App\Models\Admin\BatchStudentEnrollment;

class CourseController extends Controller
{
    public function course()
    {
        $courses = Course::where('status', 1)->paginate(8)->fragment('courses');
        return view('student.pages_new.course.course', compact('courses'));
    }

    public function coursePreview(Course $course)
    {

        $batch = '';
        $enrolled = '';
        $lectures = [];
        $course_topic_lectures = array();
        $course_topics = CourseTopic::where('course_id', $course->id)->get();
        foreach ($course_topics as $course_topic) {
            $course_topic_lectures[$course_topic->id] = array();
        }
        $course_lectures = CourseLecture::where('course_id', $course->id)->get();
        foreach ($course_lectures as $course_lecture) {
            //dd($course_lecture->topic_id,$course_lecture);
            if (!empty($course_lecture->topic_id) && !empty($course_lecture) && !isset($course_lecture->topic_id) && !isset($course_lecture)) {
                array_push($course_topic_lectures[$course_lecture->topic_id], $course_lecture);
            }
        }
        if (Auth::check()) {
            $enrolled = BatchStudentEnrollment::join('payments', 'payments.id', 'batch_student_enrollments.payment_id')
                ->where('batch_student_enrollments.course_id', $course->id)
                ->where('batch_student_enrollments.student_id', auth()->user()->id)
                ->where('payments.student_id', auth()->user()->id)
                ->first();
            if ($enrolled) {
                $batch = Batch::where('id', $enrolled->batch_id)->first();
                if ($enrolled->accepted == 1) {
                    return redirect()->route('batch-lecture', $batch->slug);
                }
            } else {
                return view('student.pages_new.course.preview_guest', compact(
                    'course',
                    'course_topics',
                    'course_lectures',
                    'course_topic_lectures',
                    'enrolled',
                    'batch'
                ));
            }
        } else {
            return view('student.pages_new.course.preview_guest', compact(
                'course',
                'course_topics',
                'course_lectures',
                'course_topic_lectures',
                'enrolled',
                'batch'
            ));
        }
     
        
    }

    public function enroll(Course $course)
    {
       
        if($course->price<=0){
            $courseFirstBatch = Batch::where('course_id', $course->id)->orderby('created_at','ASC')->select('id','slug')->first();
            if(!$courseFirstBatch){
                return redirect()->back();
            }
            $student=auth()->user();
            $payment = new Payment();
            $payment->student_id = $student->id;
            $payment->course_id = $course->id;
            $payment->name = $student->name;
            $payment->email = $student->email;
            $payment->contact = $student->phone;
            $payment->trx_id =  "FREE";
            $payment->payment_type =  "FREE";
            $payment->amount =  0;
            $payment->payment_account_number = 000;
            $payment->days_for = 365;
            $payment->accepted = 1;
            $payment->save();
            $lastPayment = Payment::latest()->first();
            $batchStudentEnrollment = BatchStudentEnrollment::updateOrCreate(
                [
                    'course_id' => $course->id,
                    'student_id' => $student->id,
                    'course_id' => $course->id
                ],
                [
                    'batch_id' => $courseFirstBatch->id,
                    'payment_id' => $lastPayment->id,
                    'course_id' => $course->id,
                    'note_list' => "Free enrolment",
                    'student_id' => $student->id,
                    'individual_batch_days' => 0,
                    'accessed_days' =>  365,
                    'status' => 1,
                ]
            );
            return redirect()->route('batch-lecture', $courseFirstBatch->slug);
        } else {
            $enrolled = BatchStudentEnrollment::join('payments', 'payments.id', 'batch_student_enrollments.payment_id')
            ->where('batch_student_enrollments.course_id', $course->id)
            ->where('batch_student_enrollments.student_id', auth()->user()->id)
            ->where('payments.student_id', auth()->user()->id)
            ->first();
            if ($enrolled) {
                $batch = Batch::where('id', $enrolled->batch_id)->first();
                if ($enrolled->accepted == 1) {
                    return redirect()->route('batch-lecture', $batch->slug);
                }
            }
            $paymentsNumber = PaymentNumber::all();
            $studentDetails = StudentDetails::where('user_id', auth()->user()->id)->first();
            return view('student.pages.course.confirm_enroll', compact('course', 'paymentsNumber', 'studentDetails'));
        }
    }

    public function invoice(Course $course, Payment $payments)
    {
        return view('student.pages.course.invoice', compact('course', 'payments'));
    }
}
