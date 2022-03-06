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
    public function initialize(Request $request, $examId)
    {
        $exam = ModelExam::query()->find($examId);
        $this->sendPayment($exam->exam_price,route('single.payment.success', $examId));
    }

    private function sendPayment($amount, $success_url)
    {
        $shurjopay_service = new ShurjopayService();
        $trx_id = $shurjopay_service->generateTxId();
        $shurjopay_service->sendPayment($amount, $success_url, []);
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

    public function initializeCategoryPayment($categoryId)
    {
        $category = ExamCategory::query()->find($categoryId);
        $this->sendPayment($category->price,route('category.single.payment.success', $categoryId));
    }

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

    public function getCategoryPayment()
    {
        $category_payments = PaymentOfCategory::query()
                                                ->with('user')
                                                ->with('singlePayment')
                                                ->with('examCategory');

        if(request()->input('query.category')) {
            $category = trim(request()->input('query.category'));
            $category_payments = $category_payments->whereHas('examCategory',function ($q) use ($category) {
                $q->where('id', $category);
            });
        }

        if(request()->input('query.student')) {
            $student = trim(request()->input('query.student'));
            $category_payments = $category_payments->whereHas('user',function ($q) use ($student) {
                $q->where('phone','like', $student.'%');
                $q->orWhere('email','like', $student.'%');
                $q->orWhere('name','like', $student.'%');
            });
        }

        if(request()->input('query.tnx')) {
            $tnxId = trim(request()->input('query.tnx'));
            $category_payments = $category_payments->whereHas('singlePayment',function ($q) use ($tnxId) {
                $q->where('tnx_id', $tnxId);
            });
        }

        $category_payments = $category_payments->paginate(10);
        $categories = ExamCategory::query()->get();

        return view('admin.pages.model_exam.payments.category-payment', compact('category_payments','categories'));
    }

    public function getExamPayment()
    {
        $exam_payments = PaymentOfExams::query()
                                        ->with('user')
                                        ->with('singlePayment')
                                        ->with('modelExam');


        if(request()->input('query.exam')) {
            $exam = trim(request()->input('query.exam'));
            $exam_payments = $exam_payments->whereHas('modelExam',function ($q) use ($exam) {
                $q->where('id', $exam);
            });
        }

        if(request()->input('query.student')) {
            $student = trim(request()->input('query.student'));
            $exam_payments = $exam_payments->whereHas('user',function ($q) use ($student) {
                $q->where('phone','like', $student.'%');
                $q->orWhere('email','like', $student.'%');
                $q->orWhere('name','like', $student.'%');
            });
        }

        if(request()->input('query.tnx')) {
            $tnxId = trim(request()->input('query.tnx'));
            $exam_payments = $exam_payments->whereHas('singlePayment',function ($q) use ($tnxId) {
                $q->where('tnx_id', $tnxId);
            });
        }

        $exam_payments = $exam_payments->paginate(10);
        $exams = ModelExam::query()->get();

        return view('admin.pages.model_exam.payments.exam-payment', compact('exam_payments','exams'));
    }
}
