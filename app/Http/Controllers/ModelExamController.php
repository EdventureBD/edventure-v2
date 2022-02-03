<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateModelExam;
use App\Models\ExamCategory;
use App\Models\ExamTopic;
use App\Models\ModelExam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ModelExamController extends Controller
{
    public function index()
    {
        $exam_categories = ExamCategory::get();
        $exams = ModelExam::query()->with('category')->with('topic')->paginate(5);

        return view('admin.pages.model_exam.exam.index', compact('exam_categories','exams'));
    }

    public function store(CreateModelExam $request)
    {
        $inputs = $request->validated();
        if($request->hasFile('solution_pdf')) {
            $filename = $request->exam_category_id.'_'.str_replace(' ', '_', $request->title).'_'.Carbon::today()->toDateString().'.pdf';
            $path = $request->file('solution_pdf')->storeAs(
                'solutionPdf', $filename, 'public'
            );
            $inputs['solution_pdf'] = $filename;
        }

        ModelExam::query()->create($inputs);

        return redirect()->back()->with('status','Exam Created Successfully');

    }

    public function destroy($id)
    {
        ModelExam::query()->find($id)->delete();

        return redirect()->back()->with('status','Exam Deleted Successfully');
    }

    public function getTopicsByCategory($categoryId)
    {
        $topics = ExamTopic::query()->select('id','name')->where('exam_category_id',$categoryId)->get();

        return response()->json($topics);
    }

    public function downloadSolutionPdf($examId)
    {
        $model_exam = ModelExam::query()->find($examId);

        $file = public_path().'/storage/solutionPdf/'.$model_exam->solution_pdf;
        return Response()->download($file);
    }
}
