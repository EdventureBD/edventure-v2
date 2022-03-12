<?php

namespace App\Http\Controllers;

use App\Models\ExamCategory;
use App\Models\ExamTag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
}
