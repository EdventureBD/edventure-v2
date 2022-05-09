<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\ExamCategory;
use App\Models\ExamTag;
use App\Models\ModelExam;
use App\Models\User;
use App\Models\UserType;
use Carbon\Carbon;
use App\Models\PaymentOfCategory;
use App\Models\PaymentOfExams;
use App\Models\SinglePayment;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        $teachers = User::query()->where('user_type', \App\Enum\UserType::TEACHER)->get();
        return view('admin.pages.model_exam.exam_category.index', compact('exam_categories','teachers'));
    }

    /**
     * Store new category data
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(CreateCategoryRequest $request)
    {
        $inputs =  $request->validated();

        if($request->hasFile('routine_image')) {
            $file = $request->file('routine_image');
            $filename = rand().'_'.Carbon::today()->toDateString().'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs(
                'categoryRoutine', $filename, 'public'
            );
            $inputs['routine_image'] = $filename;
        }

        if($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = rand().'_'.Carbon::today()->toDateString().'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs(
                'categoryImage', $filename, 'public'
            );
            $inputs['image'] = $filename;
        }

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
        $category = ExamCategory::query()->find($id);
        if($category->routine_image) {
            @unlink(public_path('storage/categoryRoutine/'.$category->routine_image));
        }
        $category->delete();
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

    public function update(UpdateCategoryRequest $request, $id)
    {
        $inputs =  $request->validated();

        if(is_null($inputs['category_video'])) {
            unset($inputs['category_video']);
        }
        if($request->hasFile('routine_image')) {
            $category = ExamCategory::query()->find($id);
            if($category->routine_image) {
                @unlink(public_path('storage/categoryRoutine/'.$category->routine_image));
            }
            $file = $request->file('routine_image');
            $filename = rand().'_'.Carbon::today()->toDateString().'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs(
                'categoryRoutine', $filename, 'public'
            );
            $inputs['routine_image'] = $filename;
        }


        if($request->hasFile('image')) {
            $category = ExamCategory::query()->find($id);
            if($category->image) {
                @unlink(public_path('storage/categoryImage/'.$category->image));
            }
            $file = $request->file('image');
            $filename = rand().'_'.Carbon::today()->toDateString().'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs(
                'categoryImage', $filename, 'public'
            );
            $inputs['image'] = $filename;
        }

        ExamCategory::query()->where('id', $id)->update($inputs);

        return redirect()->back()->with(['status' => 'Category Updated Successfully']);
    }

    public function updateCategoryVisibility($categoryId)
    {
        $category = ExamCategory::query()->find($categoryId);

        if ($category->visibility == 1) {
            $category->visibility = 0;
            $category->save();
            $flag = 'hide';
        } else {
            $category->visibility = 1;
            $category->save();
            $flag = 'visible';
        }

        return response()->json($flag);
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
