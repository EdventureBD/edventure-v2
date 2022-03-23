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
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        ExamCategory::query()->where('id', $id)->update($inputs);

        return redirect()->back()->with(['status' => 'Category Updated Successfully']);
    }


    public function updateCategoryVisibility($categoryId)
    {
        $category  = ExamCategory::query()->find($categoryId);

        if($category->visibility == 1) {
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
}
