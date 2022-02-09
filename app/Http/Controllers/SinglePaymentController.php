<?php

namespace App\Http\Controllers;

use App\Models\ModelExam;
use App\Models\PaymentOfExams;
use App\Models\SinglePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use smasif\ShurjopayLaravelPackage\ShurjopayService;

class SinglePaymentController extends Controller
{
    public function initialize(Request $request, $examId)
    {
        $exam = ModelExam::query()->find($examId);
        $shurjopay_service = new ShurjopayService();
        $trx_id = $shurjopay_service->generateTxId();
        $success_url = route('single.payment.success', $examId);
        $shurjopay_service->sendPayment($exam->exam_price, $success_url, []);
    }

    public function paymentSuccess(Request $request, $examId)
    {

        if (request()->status != "Success") {
            return redirect()->route('model.exam')->with(['failed' =>"Payment failed, please try again!"]);
        }

        DB::beginTransaction();

        try {
            $inputs = [
                'amount' => $request->amount,
                'status'=> $request->status,
                'tnx_id'=> $request->tx_id,
                'platform' => $request->sp_payment_option,
                'remarks' => $request->sp_code_des,
                'user_id' => auth()->user()->id
            ];

            $payment = SinglePayment::query()->create($inputs);

            $inputs = [
                'single_payment_id' => $payment->id,
                'model_exam_id'=> $examId,
                'user_id' => auth()->user()->id
            ];

            PaymentOfExams::query()->create($inputs);
            DB::commit();
            return redirect()->route('model.exam')->with(['success'=>"Payment Successful"]);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('model.exam')->with(['failed' =>"Payment failed, please try again!"]);
        }
    }
}
