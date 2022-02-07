<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMcqQuestionRequest;
use App\Models\ExamTag;
use App\Models\McqQuestion;
use App\Models\ModelExam;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class McqQuestionController extends Controller
{
    public function index($examId)
    {
        $exam = ModelExam::query()->where('id',$examId)->first();
        $exam_questions = McqQuestion::query()->with('examTag')
                        ->where('model_exam_id',$examId)
                        ->orderByDesc('created_at')
                        ->paginate(5);
        $tags = ExamTag::query()
                        ->where('exam_topic_id', $exam->exam_topic_id)
                        ->get();
        return view('admin.pages.model_exam.mcq_question.index', compact('exam','tags','exam_questions'));
    }

    public function store(CreateMcqQuestionRequest $request, $examId)
    {
        $exam = ModelExam::query()->find($examId);

        $inputs = array_merge($request->validated(), [
            'slug' => Str::slug($exam->title),
            'model_exam_id' => $exam->id,
        ]);

        McqQuestion::query()->create($inputs);

        return redirect()->back()->with(['status' => 'Question Added Successfully']);
    }

    public function destroy($slug)
    {
        McqQuestion::query()->where('slug', $slug)->first()->delete();

        return redirect()->back()->with(['status' => 'Question Deleted Successfully']);
    }
}
