<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

 //models
use App\Models\Admin\PopQuizMCQ;
use App\Models\Admin\PopQuizCreativeQuestion;
use App\Models\Admin\QuestionContentTag;
use App\Models\Admin\Exam;
use App\Models\Admin\ContentTag;

class PopQuizMCQController extends Controller
{
    public function all(Exam $exam)
    {
        $mcqs = PopQuizMCQ::join('exams', 'pop_quiz_mcqs.exam_id', 'exams.id')
        ->select('pop_quiz_mcqs.*', 'exams.title as examTitle')
        ->where('exam_id', $exam->id)
        ->orderby('id', 'DESC')->get();

        $cqs = PopQuizCreativeQuestion::where('exam_id', $exam->id)
        ->orderby('id', 'DESC')->get();

        return view('admin.pages.mcq_and_cq.index', compact('mcqs', 'cqs', 'exam'));
    }

    public function store(Request $request, Exam $exam)
    {
        $validaterequest = $request->validate([
            'question' => 'required|min:4|unique:pop_quiz_mcqs',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:4096',
            'field1' => 'required',
            'field2' => 'required',
            'field3' => 'required',
            'field4' => 'required',
            'answer' => 'required',
            'explanation' => 'nullable',
            'examId' => 'required',
            'slug' => 'required',
            'contentTagIds' => 'required',
        ]);

        $mcqs = new PopQuizMCQ();
        $mcqs->question = $request['question'];
        $mcqs->slug = (string) Str::uuid();
        if ($request->hasFile('image')) {
            $mcqs->image = $request->image->store('public/question/pop_quiz_mcqs');
            $mcqs->image = Storage::url($mcqs->image);
        }
        $mcqs->field1 = $request['field1'];
        $mcqs->field2 = $request['field2'];
        $mcqs->field3 = $request['field3'];
        $mcqs->field4 = $request['field4'];
        $mcqs->answer = $request['answer'];
        $mcqs->exam_id = $request->examId;
        $mcqs->explanation = $request['explanation'];
        $mcqs->number_of_attempt = 0;
        $mcqs->gain_marks = 0;
        $mcqs->success_rate = 0;

        $save = $mcqs->save();

        if ($save) {
            for ($i = 0; $i < sizeOf($request->contentTagIds); $i++) {
                $question_content_tag = new QuestionContentTag();
                $question_content_tag->exam_type = $exam->exam_type;
                $question_content_tag->question_id = $mcqs->id;
                $question_content_tag->content_tag_id = $request->contentTagIds[$i];
                $question_content_tag->save();
            }
            session()->flash('status', 'Pop Quiz MCQ created successfully!');
            return redirect()->route('exam.show', $request->slug);
        } else {
            session()->flash('failed', 'Pop Quiz MCQ creation failed!');
            return redirect()->route('addQuestion_MCQ_only');
        }
    }

    public function show(Exam $exam, PopQuizMCQ $pop_quiz_mcq)
    {
        $exam = Exam::where('id', $pop_quiz_mcq->exam_id)->first();
        // For use with recyclable blade files
        $mcq = $pop_quiz_mcq;
        return view('admin.pages.mcq_and_cq.details_mcq', compact('mcq', 'exam'));
    }

    public function edit(Exam $exam, PopQuizMCQ $pop_quiz_mcq)
    {
        $tagId = [];
        $questionContentTags = QuestionContentTag::where('exam_type', $exam->exam_type)
            ->where('question_id', $pop_quiz_mcq->id)
            ->get();

        foreach ($questionContentTags as $qct) {
            array_push($tagId, $qct->content_tag_id);
        }

        if ($exam->special == 1) {
            $contentTags = ContentTag::where('course_id', $exam->course_id)
                ->whereNotIn('id', $tagId)
                ->get();
        } else {
            $contentTags = ContentTag::where('course_id', $exam->course_id)
                ->where('topic_id', $exam->topic_id)
                ->whereNotIn('id', $tagId)
                ->get();
        }

        return view('admin.pages.mcq_and_cq.edit_mcq', compact('pop_quiz_mcq', 'exam', 'contentTags', 'questionContentTags'));
    }

    public function update(Request $request, Exam $exam, PopQuizMCQ $pop_quiz_mcq)
    {
        $validaterequest = $request->validate([
            'question' => 'required|min:4',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:4096',
            'field1' => 'required',
            'field2' => 'required',
            'field3' => 'required',
            'field4' => 'required',
            'answer' => 'required',
            'explanation' => 'nullable',
            'examId' => 'required',
            'slug' => 'required',
            'contentTagIds' => 'required',
        ]);

        if ($request->hasFile('image')) {
            if ($pop_quiz_mcq->image) {
                Storage::delete($pop_quiz_mcq->image);
            }
            $pop_quiz_mcq->image = $request->image->store('public/question/mcq');
            $pop_quiz_mcq->image = Storage::url($pop_quiz_mcq->image);
        }

        $pop_quiz_mcq->question = $request['question'];
        $pop_quiz_mcq->field1 = $request['field1'];
        $pop_quiz_mcq->field2 = $request['field2'];
        $pop_quiz_mcq->field3 = $request['field3'];
        $pop_quiz_mcq->field4 = $request['field4'];
        $pop_quiz_mcq->answer = $request['answer'];
        $pop_quiz_mcq->explanation = $request['explanation'];
        $pop_quiz_mcq->exam_id = $request['examId'];        

        $save = $pop_quiz_mcq->save();

        $deleteContentTags = QuestionContentTag::where('exam_type', $exam->exam_type)
            ->where('question_id', $pop_quiz_mcq->id)
            ->get();

        foreach ($deleteContentTags as $deleteContentTag) {
            $deleteContentTag->delete();
        }

        if ($save) {
            for ($i = 0; $i < sizeOf($request->contentTagIds); $i++) {
                $question_content_tag = new QuestionContentTag();
                $question_content_tag->exam_type = $exam->exam_type;
                $question_content_tag->question_id = $pop_quiz_mcq->id;
                $question_content_tag->content_tag_id = $request->contentTagIds[$i];
                $question_content_tag->save();
            }
            session()->flash('status', 'Pop Quiz MCQ edited successfully!');
            return redirect()->route('exam.show', $request->slug);
        } else {
            session()->flash('failed', 'Pop Quiz MCQ edit failed!');
            return redirect()->route('aptitude-test-mcqs.create');
        }
    }

    public function destroy(Exam $exam, PopQuizMCQ $pop_quiz_mcq)
    {
        $exam = Exam::where('id', $pop_quiz_mcq->exam_id)->first();

        $question_content_tags = QuestionContentTag::where("exam_type", $exam->exam_type)->where('question_id', $pop_quiz_mcq->id)->get();

        foreach($question_content_tags as $question_content_tag){
            $question_content_tag->delete();
        }

        $delete = $pop_quiz_mcq->delete();
        if ($delete) {
            return redirect()->route('exam.show', $exam)->with('status', 'Pop Quiz MCQ deleted successfully!');
        } else {
            return redirect()->route('exam.show', $exam)->with('failed', 'Pop Quiz MCQ deletion failed!');
        }
    }
}
