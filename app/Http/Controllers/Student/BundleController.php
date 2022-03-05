<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use smasif\ShurjopayLaravelPackage\ShurjopayService;

// models
use App\Models\Admin\Bundle;
use App\Models\BundleStudentEnrollment;
use App\Models\BundlePayment;

class BundleController extends Controller
{
    public function bundlePreview($bundle_slug)
    {
        $bundle = Bundle::where('slug', $bundle_slug)->firstOrFail();

        $enrolled = BundleStudentEnrollment::join('bundle_payments', 'bundle_payments.id', 'bundle_student_enrollments.payment_id')
        ->where('bundle_student_enrollments.bundle_id', $bundle->id)
        ->where('bundle_student_enrollments.student_id', auth()->user()->id)
        ->where('bundle_payments.student_id', auth()->user()->id)
        ->first();

        // if already enrolled, go to courses page
        if($enrolled){
            return redirect()->route('bundle_courses', $bundle->slug);
        }

        // else, go to preview page
        $bundle = Bundle::where('slug', $bundle_slug)
                        ->with('courses.courseTopic.CourseLecture')
                        ->firstOrFail();
                    
        return view('student.pages_new.bundle.preview_guest', compact('bundle'));
    }

    public function bundle_enroll(Bundle $bundle)
    {
        // dd($bundle);
        $enrolled = BundleStudentEnrollment::join('bundle_payments', 'bundle_payments.id', 'bundle_student_enrollments.payment_id')
            ->where('bundle_student_enrollments.bundle_id', $bundle->id)
            ->where('bundle_student_enrollments.student_id', auth()->user()->id)
            ->where('bundle_payments.student_id', auth()->user()->id)
            ->first();

        // dd($enrolled);
        
        // if a student is enrolled and status is 0
        if ($enrolled && $enrolled->status == 0) {
            return redirect()->route('bundle-preview', $bundle->slug);
        }

        // if course is free
        if($bundle->price <= 0){
            // check if batch exists. If not, redirect with error.
            // $bundleFirst = Bundle::where('bundle_id', $bundle->id)->orderby('created_at','ASC')->select('id','slug')->first();
            // if(!$bundleFirst){
            //     return redirect()->back()->withErrors([ 'No batch is available now, please try again later!']);
            // }

            $student = auth()->user();

            $payment = new BundlePayment();
            $payment->student_id = $student->id;
            $payment->bundle_id = $bundle->id;
            // $payment->batch_id = $bundleFirst->id;
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

            $batchStudentEnrollment = BundleStudentEnrollment::updateOrCreate(
                [
                    'bundle_id' => $bundle->id,
                    'student_id' => $student->id
                ],
                [
                    // 'batch_id' => $courseFirstBatch->id,
                    'payment_id' => $payment->id,
                    // 'bundle_id' => $bundle->id,
                    'note_list' => "Free enrolment",
                    'student_id' => $student->id,
                    'individual_bundle_days' => 0,
                    'accessed_days' =>  365,
                    'status' => 1,
                ]
            );

            // dd("Free enrollment successful. Go to bundle page.");

            return redirect()->route('bundle_courses', $bundle->slug);
        }
        // if course is NOT free
        else {
            // if ($enrolled) {
            //     $batch = Batch::where('id', $enrolled->batch_id)->first();
                
            //     if (($enrolled->accepted == 1 && $batch->batch_running_days <= $enrolled->accessed_days) || $enrolled->status == 0) {
            //         return redirect()->route('course-preview', $course->slug);
            //     }
            //     $enroll_months = $this->calculateEnrolMonths($batch->batch_running_days - $enrolled->accessed_days);
            // }
            // else {
            //     $batch = Batch::where('course_id', $course->id)->where('status', 1)->orderBy('updated_at', 'desc')->first();
            //     if (!$batch) {
            //         return back()->withErrors([ 'No batch is available now, please try again later!']);
            //     }
            //     $enroll_months = $this->calculateEnrolMonths($batch->batch_running_days);
            // }
            // $paymentsNumber = PaymentNumber::all();
            // $studentDetails = StudentDetails::where('user_id', auth()->user()->id)->first();
            // dd($studentDetails);
            $student = auth()->user();

            return view('student.pages_new.bundle.confirm_enroll', compact('bundle', 'student'));
        }
    }

    public function bundle_courses(Bundle $bundle){
        $bundle = Bundle::where('slug', $bundle->slug)->with('courses')->firstOrFail();

        return view('student.pages_new.bundle.bundle_courses', compact('bundle'));
    }

    public function processPayment(Bundle $bundle, Request $request){
        // dd('Bundle processPayment method', $bundle, $request);
        // $enrolled = (new BatchStudentEnrollment())->getEnrollment($course->id, auth()->user()->id);
        // if ($enrolled) {
        //     $batch = (new Batch())->getById($enrolled->batch_id);
        //     $enroll_months = $this->calculateEnrolMonths($batch->batch_running_days - $enrolled->accessed_days);
        // }
        // else {
        //     $batch = Batch::where('course_id', $course->id)->where('status', 1)->orderBy('updated_at', 'desc')->first();

        //     $enroll_months = $this->calculateEnrolMonths($batch->batch_running_days);
        // }
        
        // request()->validate([
        //     'months'=>'numeric|min:'.$enroll_months
        // ]);
        // $days = request()->months * 30;
        
        
        
        $price = $request->bundle_price;
        // dd($price);
        $shurjopay_service = new ShurjopayService();
        $trx_id = $shurjopay_service->generateTxId();

        //Creating payment with accepted =0 ;
        // $payOpt = ['bundle_id'=>$bundle->id, 'accepted'=> 0, "trx"=>$trx_id, "payment_type"=>Payment::SHURJO_PAY, "days"=>$days, 'price'=>$price];
        // $payment = (new Payment())->savePayment(auth()->user(), $course, $payOpt);
        //Process Payment with ShurjoPay

        $user = auth()->user();

        $bundle_payment = new BundlePayment();
        $bundle_payment->student_id = auth()->user()->id;
        $bundle_payment->bundle_id = $bundle->id;
        $bundle_payment->name = $user->name;
        $bundle_payment->email = $user->email;
        $bundle_payment->contact = $user->phone;
        $bundle_payment->trx_id = $trx_id;
        $bundle_payment->payment_type = 'SHURJO_PAY';
        $bundle_payment->amount = $bundle->price;
        $bundle_payment->payment_account_number = '000';
        $bundle_payment->days_for = 365;
        $bundle_payment->accepted = 0;
        $bundle_payment->save();

        // "trx_id" =>  !empty($opt['trx']) ? $opt['trx'] : self::FREE,
        // "payment_type" =>  !empty($opt['payment_type']) ? $opt['payment_type'] : self::FREE,
        // "amount" =>  !empty($opt['price']) ? $opt['price'] : 0,
        // "payment_account_number" => !empty($opt['bank_trx']) ? $opt['bank_trx'] : "000",
        // "days_for" => !empty($opt['days']) ? $opt['days'] : 365,
        // "accepted" => !empty($opt['accepted']) ? $opt['accepted'] : 0

        $success_url = route('bundle_payment_success', $bundle->slug);
        $shurjopay_service->sendPayment($price, $success_url);
    }

    public function bundle_islands(Bundle $bundle)
    {
        
    }
}
