<?php

namespace App\Http\Controllers;

use App\Models\ExamCategory;
use App\Models\ExamTopic;
use Illuminate\Http\Request;

class ModelExamController extends Controller
{
    public function index()
    {
        $exam_categories = ExamCategory::get();


        return view('admin.pages.model_exam.exam.index', compact('exam_categories'));
    }

    public function store(Request $request)
    {

    }
    public function getTopicsByCategory($categoryId)
    {
        $topics = ExamTopic::query()->select('id','name')->where('exam_category_id',$categoryId)->get();

        return response()->json($topics);
    }
}
