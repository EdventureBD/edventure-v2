<?php

namespace App\Http\Controllers\Student;

use App\Models\Admin\Batch;
use App\Models\Admin\Course;
use App\Models\Admin\Payment;
use App\Http\Controllers\Controller;
use App\Models\Admin\BatchStudentEnrollment;
use App\Models\Admin\CourseCategory;
use App\Models\Admin\IntermediaryLevel;
use App\Models\Admin\Bundle;
use App\Models\BundleStudentEnrollment;
use Illuminate\Support\Facades\Session;
use smasif\ShurjopayLaravelPackage\ShurjopayService;

class CourseController extends Controller
{
    public function course($category_slug=null, $intermediary_level_slug = null)
    {
        $categories=CourseCategory::where('status',1)
        ->orderBy('id', "ASC")
        ->select('title','slug')
        ->get();

        if(isset($category_slug) && !empty($category_slug)){
            $category = CourseCategory::where('status',1)->where('slug', $category_slug)->first();
            if(!$category){
                $category = CourseCategory::where('slug', $category_slug)->first();
                if($category && $category->status == 0){
                    return redirect()->route('course')->withErrors(['status_false' => 'This course category is unavailable right now. Please check later.']);
                }
                else{
                    return redirect()->route('course')->withErrors(['not_found' => 'This course category doesn\'t exist.']);
                }
            }
            $selected_category_slug = $category->slug;
        }
        else{
            $category=null;
            $selected_category_slug = null;
        }

        if($category){
            $intermediary_levels = IntermediaryLevel::where('status', 1)
            ->where('course_category_id', $category->id)
            ->select('title', 'slug', 'course_category_id')
            ->paginate(8)
            ->fragment('intermediary_levels');
        }
        else{
            $intermediary_levels = null;
        }

        if(isset($intermediary_level_slug) && !empty($intermediary_level_slug)){
            $selected_intermediary_level = IntermediaryLevel::where('status',1)->where('slug', $intermediary_level_slug)->first();

            if(!$selected_intermediary_level){
                $selected_intermediary_level = IntermediaryLevel::where('slug', $intermediary_level_slug)->first();
                if($selected_intermediary_level && $selected_intermediary_level->status == 0){
                    return redirect()->route('course')->withErrors(['status_false' => 'This program is unavailable right now. Please check later.']);
                }
                else{
                    return redirect()->route('course')->withErrors(['not_found' => 'This program doesn\'t exist.']);
                }
            }
        }
        else{
            $selected_intermediary_level = null;
        }

        if($selected_intermediary_level){
            $courses = Course::where('intermediary_level_id', $selected_intermediary_level->id)
                                ->where('status', 1)
                                ->where('bundle_id', null)
                                ->get();

            $bundles = Bundle::where('intermediary_level_id', $selected_intermediary_level->id)
                                ->where('status', 1)
                                ->get();
        }
        else{
            $courses = collect();
            $bundles = collect();
        }

        return view('student.pages_new.course.course', compact('categories','selected_category_slug', 'intermediary_levels', 'selected_intermediary_level', 'courses', 'bundles'));
    }

    public function courseByCategory($category_slug){
        $category=CourseCategory::where('status',1)->where('slug',$category_slug)->first();
        $courses=Course::where('status', 1)
                ->where('course_category_id',$category->id)
                ->orderBy('order')
                ->take(8)
                ->select('title','slug','icon','banner','course_category_id','price')
                ->get();
        return response()->json($courses);
    }

    public function coursePreview(Course $course)
    {
        if($course->status == 0){
            return redirect()->route('course')->withErrors(['status_false' => 'This course category is unavailable right now. Please check later.']);
        }

        if($course->bundle_id != null){
            // checks if bundle exists. Else, will throw not found error
            $bundle = Bundle::where('id', $course->bundle_id)->firstOrFail();
            if(auth()->check()){
                $enrollment = BundleStudentEnrollment::query()
                                                    ->where('bundle_id', $bundle->id)
                                                    ->where('student_id', auth()->user()->id)
                                                    ->first();
                // check if this dude is enrolled in this bundle or not
                if($enrollment == null){
                    return redirect()->route('bundle-preview', ['bundle_slug' => $bundle->slug])->withErrors(['not_enrolled' => 'Access Denied! You are not enrolled in this bundle.']);
                }
            }
            else{
                return redirect()->route('bundle-preview', ['bundle_slug' => $bundle->slug])->withErrors(['not_enrolled' => 'Please login/register to access this bundle.']);
            }
        }

        $batch = '';
        $enrolled = '';
        $course_topics = $course->load('CourseTopic');

        if (auth()->check()) {
            $enrolled = BatchStudentEnrollment::query()
                                                ->where('course_id', $course->id)
                                                ->where('student_id', auth()->user()->id)
                                                ->first();
            if ($enrolled && $enrolled->status) {

                $batch = Batch::where('id', $enrolled->batch_id)->first();

                return redirect()->route('batch-lecture', $batch->slug);
            } else {
                if ($enrolled && !$enrolled->status)
                    Session::flash('message', 'Please contact admin to access your course!');

                return view('student.pages_new.course.preview_guest', compact(
                    'course',
                    'course_topics',
                    'enrolled'
                ));
            }
        } else {
            return view('student.pages_new.course.preview_guest', compact(
                'course',
                'course_topics',
                'enrolled',
                'batch'
            ));
        }
    }

    public function enroll(Course $course)
    {
        $enrolled = BatchStudentEnrollment::join('payments', 'payments.id', 'batch_student_enrollments.payment_id')
            ->where('batch_student_enrollments.course_id', $course->id)
            ->where('batch_student_enrollments.student_id', auth()->user()->id)
            ->where('payments.student_id', auth()->user()->id)
            ->first();

        // if a student is enrolled and status is 0
        if ($enrolled && $enrolled->status == 0) {
            return redirect()->route('course-preview', $course->slug);
        }

        // if course is free
        if($course->price <= 0){
            // check if batch exists. If not, redirect with error.
            $courseFirstBatch = Batch::where('course_id', $course->id)->orderby('created_at','ASC')->select('id','slug')->first();
            if(!$courseFirstBatch){
                return redirect()->back()->withErrors([ 'No batch is available now, please try again later!']);
            }

            $student=auth()->user();
            $payment = new Payment();
            $payment->student_id = $student->id;
            $payment->course_id = $course->id;
            $payment->batch_id = $courseFirstBatch->id;
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

            $batchStudentEnrollment = BatchStudentEnrollment::updateOrCreate(
                [
                    'course_id' => $course->id,
                    'student_id' => $student->id
                ],
                [
                    'batch_id' => $courseFirstBatch->id,
                    'payment_id' => $payment->id,
                    'course_id' => $course->id,
                    'note_list' => "Free enrolment",
                    'student_id' => $student->id,
                    'individual_batch_days' => 0,
                    'accessed_days' =>  365,
                    'status' => 1,
                ]
            );
            return redirect()->route('batch-lecture', $courseFirstBatch->slug);
        }
        // if course is NOT free
        else {
            if ($enrolled) {
                $batch = Batch::where('id', $enrolled->batch_id)->first();

                if (($enrolled->accepted == 1 && $batch->batch_running_days <= $enrolled->accessed_days) || $enrolled->status == 0) {
                    return redirect()->route('course-preview', $course->slug);
                }
                $enroll_months = $this->calculateEnrolMonths($batch->batch_running_days - $enrolled->accessed_days);
            }
            else {
                $batch = Batch::where('course_id', $course->id)->where('status', 1)->orderBy('updated_at', 'desc')->first();
                if (!$batch) {
                    return back()->withErrors([ 'No batch is available now, please try again later!']);
                }
                $enroll_months = $this->calculateEnrolMonths($batch->batch_running_days);
            }
            // $paymentsNumber = PaymentNumber::all();
            // $studentDetails = StudentDetails::where('user_id', auth()->user()->id)->first();
            // dd($studentDetails);
            $student = auth()->user();

            return view('student.pages_new.course.confirm_enroll', compact('course', 'student', 'batch', 'enroll_months'));
        }
    }

    public function processPayment(Course $course)
    {
        $enrolled = (new BatchStudentEnrollment())->getEnrollment($course->id, auth()->user()->id);
        if ($enrolled) {
            $batch = (new Batch())->getById($enrolled->batch_id);
            $enroll_months = $this->calculateEnrolMonths($batch->batch_running_days - $enrolled->accessed_days);
        }
        else {
            $batch = Batch::where('course_id', $course->id)->where('status', 1)->orderBy('updated_at', 'desc')->first();

            $enroll_months = $this->calculateEnrolMonths($batch->batch_running_days);
        }

        request()->validate([
            'months'=>'numeric|min:'.$enroll_months
        ]);

        $price = $course->price * request()->months;
        // dd($price);
        $days = request()->months * 30;
        $shurjopay_service = new ShurjopayService();
        $trx_id = $shurjopay_service->generateTxId();

        //Creating payment with accepted =0 ;
        $payOpt = ['batch_id'=>$batch->id, 'accepted'=> 0, "trx"=>$trx_id, "payment_type"=>Payment::SHURJO_PAY, "days"=>$days, 'price'=>$price];
        $payment = (new Payment())->savePayment(auth()->user(), $course, $payOpt);
        //Process Payment with ShurjoPay
        $success_url = route('payment.success', $course->slug);
        $shurjopay_service->sendPayment($price, $success_url, []);
    }

    public function invoice(Course $course, Payment $payments)
    {
        return view('student.pages.course.invoice', compact('course', 'payments'));
    }

    public function calculateEnrolMonths($days=0)
    {
        $months = 1;
        if($days > 30) {
            $months = ceil($days/30);
        }
        return $months;
    }
}
