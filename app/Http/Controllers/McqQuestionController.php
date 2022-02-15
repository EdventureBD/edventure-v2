<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMcqQuestionRequest;
use App\Http\Requests\UpdateMcqQuestionRequest;
use App\Models\ExamTag;
use App\Models\ExamTopic;
use App\Models\McqQuestion;
use App\Models\ModelExam;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class McqQuestionController extends Controller
{
    public function index($examId)
    {
        $exam = ModelExam::query()->where('id',$examId)->firstOrFail();
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

    public function edit($slug)
    {
        $mcqQuestion = McqQuestion::query()->where('slug',$slug)->with('examTag')->firstOrFail();
        return view('admin.pages.model_exam.mcq_question.edit', compact('mcqQuestion'));
    }

    public function update(UpdateMcqQuestionRequest $request, $id)
    {
        $inputs =  $request->validated();

        McqQuestion::query()->where('id', $id)->update($inputs);

        return redirect()->back()->with(['status' => 'Question Updated Successfully']);
    }

    public function destroy($slug)
    {
        McqQuestion::query()->where('slug', $slug)->firstOrFail()->delete();

        return redirect()->back()->with(['status' => 'Question Deleted Successfully']);
    }
}
