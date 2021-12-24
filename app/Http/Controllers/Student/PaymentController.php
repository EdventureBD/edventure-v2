<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Models\Admin\Payment;
use App\Http\Controllers\Controller;
use App\Models\Admin\Batch;
use App\Models\Admin\BatchStudentEnrollment;
use App\Models\Admin\Course;
use App\Utils\Payment as UtilsPayment;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    public function payments($id)
    {
        $payments = Payment::where('student_id', $id)->get();
        // dd($payments);
        return view('student.pages.payment.index', compact('payments'));
    }

    public function paymentSuccess(Course $course)
    {
        if (request()->status != "Success") {
            return redirect()->route('enroll', $course)->withErrors(['msg'=>"Payment failed, please try again!"]);
        }
        $data = ["course"=>$course, 'requests'=>request()->all()];
        $payment = (new Payment)->getByTrxCourse(request()->tx_id, $course->id);
        if (!$payment) {
            return redirect()->route('enroll', $course)->withErrors(['msg'=>"Payment invalid, please try again!"]);
        } 
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
