<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use smasif\ShurjopayLaravelPackage\ShurjopayService;

// models
use App\Models\Admin\Bundle;
use App\Models\BundlePayment;
use App\Models\BundleStudentEnrollment;

class BundlePaymentController extends Controller
{
    public function paymentSuccess(Bundle $bundle, Request $request)
    {
        if (request()->status != "Success") {
            return redirect()->route('bundle_enroll', $bundle)->withErrors(['msg' => "Payment failed, please try again!"]);
        }

        $bundle_payment = BundlePayment::where('trx_id', $request->tx_id)->where('bundle_id', $bundle->id)->first();

        if($bundle_payment){
            $bundle_payment->accepted = 1;
            $bundle_payment->save();

            $bundle_enrollment = new BundleStudentEnrollment();
            $bundle_enrollment->bundle_id = $bundle->id;
            $bundle_enrollment->payment_id = $bundle_payment->id;
            $bundle_enrollment->student_id = auth()->user()->id;
            $bundle_enrollment->note_list = 'Paid bundle for price of '.$bundle->price;
            $bundle_enrollment->individual_bundle_days = 0;
            $bundle_enrollment->accessed_days = 365;
            $bundle_enrollment->status = 1;
            $bundle_enrollment->save();

            return redirect()->route('bundle_courses', $bundle->slug)->with('payment_success', "Your payment was successful.");
        }
        else{
            return redirect()->route('bundle_enroll', $bundle)->withErrors(['msg' => "Something when wrong !! Please try again."]);
        }
    }
}
