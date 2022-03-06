<?php

namespace App\Http\Controllers;

use App\Models\ExamCategory;
use App\Models\ModelExam;
use App\Models\PaymentOfCategory;
use App\Models\PaymentOfExams;
use App\Models\SinglePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use smasif\ShurjopayLaravelPackage\ShurjopayService;

class SinglePaymentController extends Controller
{
    /**
     * initialize process for single model exam payment
     * @param Request $request
     * @param $examId
     * @return void
     */
    public function initialize(Request $request, $examId)
    {
        $exam = ModelExam::query()->find($examId);
        $this->sendPayment($exam->exam_price,route('single.payment.success', $examId));
    }

    /**
     * This function will only use for sending payment request to surjoPay service
     * Need to generate a transaction id and the hit the payment service
     * @param $amount
     * @param $success_url
     * @return void
     */
    private function sendPayment($amount, $success_url)
    {
        $shurjopay_service = new ShurjopayService();
        $trx_id = $shurjopay_service->generateTxId();
        $shurjopay_service->sendPayment($amount, $success_url, []);
    }

    /**
     * After completing the exam payment process surjopay will redirect back to this route
     * @param Request $request
     * @param $examId
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * initialize process for category model exam payment
     * @param $categoryId
     * @return void
     */
    public function initializeCategoryPayment($categoryId)
    {
        $category = ExamCategory::query()->find($categoryId);
        $this->sendPayment($category->price,route('category.single.payment.success', $categoryId));
    }

    /**
     * After completing the category payment process surjopay will redirect back to this route
     * @param Request $request
     * @param $categoryId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function CategoryPaymentSuccess(Request $request, $categoryId)
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
                'exam_category_id'=> $categoryId,
                'user_id' => auth()->user()->id
            ];

            PaymentOfCategory::query()->create($inputs);
            DB::commit();
            return redirect()->route('model.exam')->with(['success'=>"Payment Successful"]);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('model.exam')->with(['failed' =>"Payment failed, please try again!"]);
        }
    }
}
