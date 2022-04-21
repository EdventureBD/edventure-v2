<?php

namespace App\Http\Controllers;

use App\Models\ExamCategory;
use App\Models\ExamTag;
use App\Models\PaymentOfCategory;
use App\Models\PaymentOfExams;
use App\Models\SinglePayment;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use smasif\ShurjopayLaravelPackage\ShurjopayService;

class ExamCategoryController extends Controller
{
    /**
     * Load model exam index page to view category list and create new category
     * @return Application|Factory|View
     */
    public function index()
    {
        $exam_categories = ExamCategory::query()->orderByDesc('created_at')->paginate(5);
        return view('admin.pages.model_exam.exam_category.index', compact('exam_categories'));
    }

    /**
     * Store new category data
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $inputs =  $request->validate([
            'name' => 'required|unique:exam_categories',
            'price' => 'nullable|numeric',
            'details' => 'nullable',
        ]);

        ExamCategory::create($inputs);
        return redirect()->back()->with(['status' => 'Category Created Successfully']);
    }

    /**
     * Delete specific exam category
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        if($this->hasTopics($id)) {
            return redirect()->back()->with(['warning' => 'Can not delete Category! This Category has its associative topics']);
        }
        ExamCategory::query()->find($id)->delete();
        return redirect()->back()->with(['status' => 'Category Deleted Successfully']);
    }

    /**
     * Check if the category has its associative topics
     * If category has topics, it can not be deleted
     * @param $categoryId
     * @return bool
     */
    private function hasTopics($categoryId)
    {
        return ExamCategory::query()->where('id',$categoryId)->has('examTopics')->exists();
    }

    public function update(Request $request, $id)
    {
        $inputs =  $request->validate([
            'name' => 'required',
            'price' => 'nullable|numeric',
            'details' => 'nullable',
        ]);
//        if(ExamCategory::query()->where('name',$inputs['name'])->exists()) {
//            unset($inputs['name']);
//        }
//
//        return $inputs;

        ExamCategory::query()->where('id', $id)->update($inputs);

        return redirect()->back()->with(['status' => 'Category Updated Successfully']);
    }

    /**
     * Give free access to a student of paid category
     * Admin panel section
     * @return Application|Factory|View
     */
    public function categoryAccessIndex()
    {
        $users = Cache::rememberForever('usersList', function () {
            return User::query()->select('id','email')->where('user_type', 3)->get();
        });

        $categories = Cache::rememberForever('categoriesList', function () {
            return ExamCategory::query()->whereNotNull('price')
                                        ->Where('price','>',0)->get();
        });

        $category_list = PaymentOfCategory::query()->with('examCategory')->with('singlePayment')
                                            ->with('user')
                                            ->whereHas('singlePayment', function ($q) {
                                                $q->where('platform','Admin');
                                            })->paginate(5);
        return view('admin.pages.model_exam.free_category_access.index', compact('users','categories','category_list'));
    }

    public function confirmCategoryAccess(Request $request)
    {
        $inputs = $request->validate([
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:exam_categories,id',
        ]);

        $alreadyPaid = PaymentOfCategory::query()->where('exam_category_id', $inputs['category_id'])
                                                    ->where('user_id',$inputs['user_id'])->exists();
        if($alreadyPaid) {
            return redirect()->back()->with(['failed' => 'Already Paid For this category']);
        }

        $category = ExamCategory::find($inputs['category_id']);

        $shurjopay_service = new ShurjopayService();
        $tnx = $shurjopay_service->generateTxId();

        DB::beginTransaction();

        try {
            $singlePaymentData = [
                'amount' => $category->price,
                'status'=> 'Success',
                'tnx_id'=> $tnx,
                'platform' => 'Admin',
                'remarks' => 'Accesses by admin',
                'user_id' => auth()->user()->id
            ];

            $payment = SinglePayment::query()->create($singlePaymentData);

            $paymentData = [
                'single_payment_id' => $payment->id,
                'exam_category_id'=> $inputs['category_id'],
                'user_id' => $inputs['user_id'],
                'tnx_id'=> $tnx,
            ];

            PaymentOfCategory::query()->create($paymentData);
            DB::commit();
            return redirect()->back()->with(['status' => "Successful"]);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['failed' =>"Failed, please try again!"]);
        }
    }
}
