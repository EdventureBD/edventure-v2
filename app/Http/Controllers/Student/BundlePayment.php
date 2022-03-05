<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use smasif\ShurjopayLaravelPackage\ShurjopayService;

class BundlePayment extends Controller
{
    public function paymentSuccess(Bundle $bundle, Request $request)
    {
        if (request()->status != "Success") {
            return redirect()->route('bundle_enroll', $bundle)->withErrors(['msg'=>"Payment failed, please try again!"]);
        }

        dd($request);
        // $data = ["course"=>$course, 'requests'=>request()->all()];
        
        // $shurjopay_service = new ShurjopayService();
        // $data = $shurjopay_service->decrypt($request->spdata);



        $batch = (new Batch())->find($payment->batch_id);
        if (!$batch) {
            return redirect()->route('enroll', $course)->withErrors(['msg'=>"Batch not found, please contact for available batch!"]);
        } 
        //update payment
        $payment = (new Payment())->saveData(['accepted'=>1, 'payment_account_number'=>request()->bank_tx_id], $payment->id);
        $student = auth()->user();
        $enrolled = (new BatchStudentEnrollment())->getEnrollment($course->id,$student->id);
        $access_days = $enrolled ? $enrolled->accessed_days + $payment->days_for : $payment->days_for;
        $batchStudentEnrollment = BatchStudentEnrollment::updateOrCreate(
            [
                'course_id' => $course->id,
                'student_id' => $student->id,
            ],
            [
                'batch_id' => $batch->id,
                'payment_id' => $payment->id,
                'course_id' => $course->id,
                'note_list' => "Payment for ".$payment->days_for,
                'student_id' => $student->id,
                'individual_batch_days' => 0,
                'accessed_days' => $access_days,
                'status' => 1,
            ]
        );
        return redirect()->route('batch-lecture', $batch->slug)->with('payment_success', "Your payment Successfull.");
    }
}
