<?php

namespace App\Http\Controllers;

use App\Models\ExamCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class ExamCategoryController extends Controller
{
    /**
     * Load exam model index page to view category list and create new category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $exam_categories = ExamCategory::query()->paginate(5);
        return view('admin.pages.model_exam.exam_category.index', compact('exam_categories'));
    }

    /**
     * Store new category data
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $inputs =  $request->validate([
            'name' => 'required|unique:exam_categories',
        ]);

        ExamCategory::create($inputs);
        return redirect()->back()->with(['status' => 'Category Created Successfully']);
    }

    public function destroy($id)
    {
        ExamCategory::query()->find($id)->delete();
        return redirect()->back()->with(['status' => 'Category Deleted Successfully']);
    }
}
