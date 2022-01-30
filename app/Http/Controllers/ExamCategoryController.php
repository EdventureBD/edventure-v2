<?php

namespace App\Http\Controllers;

use App\Models\ExamCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class ExamCategoryController extends Controller
{
    public function index()
    {
        $exam_categories = ExamCategory::query()->paginate(10);
        return view('admin.pages.model_exam.exam_category.index', compact('exam_categories'));
    }

    public function store(Request $request)
    {

        $inputs =  $request->validate([
            'name' => 'required|unique:exam_categories',
        ]);

        ExamCategory::create($inputs);
        return redirect()->back()->with(['status' => 'Category Created Successfully']);


    }
}
