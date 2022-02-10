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

        $type = "Pop Quiz";
        $mcq_show_route = "pop-quiz-mcq.show";
        $mcq_edit_route = "pop-quiz-mcq.edit";
        $mcq_destroy_route = "pop-quiz-mcq.destroy";

        $cq_show_route = "pop-quiz-cq.show";
        $cq_edit_route = "pop-quiz-cq.edit";
        $cq_destroy_route = "pop-quiz-cq.destroy";

        return view('admin.pages.mcq_and_cq.index', compact(
            'mcqs',
            'cqs',
            'exam',
            'type',
            'mcq_show_route',
            'mcq_edit_route',
            'mcq_destroy_route',
            'cq_show_route',
            'cq_edit_route',
            'cq_destroy_route',
        ));
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

        $mcq = new PopQuizMCQ();
        $mcq->question = $request['question'];
        $mcq->slug = (string) Str::uuid();
        if ($request->hasFile('image')) {
            $mcq->image = $request->image->store('public/question/pop_quiz_mcqs');
            $mcq->image = Storage::url($mcq->image);
        }
        $mcq->field1 = $request['field1'];
        $mcq->field2 = $request['field2'];
        $mcq->field3 = $request['field3'];
        $mcq->field4 = $request['field4'];
        $mcq->answer = $request['answer'];
        $mcq->exam_id = $request->examId;
        $mcq->explanation = $request['explanation'];
        $mcq->number_of_attempt = 0;
        $mcq->gain_marks = 0;
        $mcq->success_rate = 0;

        $save = $mcq->save();

        if ($save) {
            for ($i = 0; $i < sizeOf($request->contentTagIds); $i++) {
                $question_content_tag = new QuestionContentTag();
                $question_content_tag->exam_type = $exam->exam_type.' MCQ';
                $question_content_tag->question_id = $mcq->id;
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

    public function show(Exam $exam, $pop_quiz_mcq_slug)
    {
        $mcq = PopQuizMCQ::where('slug', $pop_quiz_mcq_slug)->firstOrFail();
        // For use with recyclable blade files
        $type = "Pop Quiz";
        return view('admin.pages.mcq_and_cq.details_mcq', compact('mcq', 'exam', 'type'));
    }

    public function edit(Exam $exam, $pop_quiz_mcq_slug)
    {
        $mcq = PopQuizMCQ::where('slug', $pop_quiz_mcq_slug)->firstOrFail();
        $tagId = [];
        $questionContentTags = QuestionContentTag::where('exam_type', $exam->exam_type.' MCQ')
            ->where('question_id', $mcq->id)
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

        $type = "Pop Quiz";
        $update_route = 'pop-quiz-mcq.update';

        return view('admin.pages.mcq_and_cq.edit_mcq', compact('mcq', 'exam', 'contentTags', 'questionContentTags', 'type', 'update_route'));
    }

    public function update(Request $request, Exam $exam, $pop_quiz_mcq_slug)
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

        $mcq = PopQuizMCQ::where('slug', $pop_quiz_mcq_slug)->firstOrFail();

        if ($request->hasFile('image')) {
            if ($mcq->image) {
                Storage::delete($mcq->image);
            }
            $mcq->image = $request->image->store('public/question/pop_quiz_mcqs');
            $mcq->image = Storage::url($mcq->image);
        }

        $mcq->question = $request['question'];
        $mcq->field1 = $request['field1'];
        $mcq->field2 = $request['field2'];
        $mcq->field3 = $request['field3'];
        $mcq->field4 = $request['field4'];
        $mcq->answer = $request['answer'];
        $mcq->explanation = $request['explanation'];
        $mcq->exam_id = $request['examId'];        

        $save = $mcq->save();

        $deleteContentTags = QuestionContentTag::where('exam_type', $exam->exam_type.' MCQ')
            ->where('question_id', $mcq->id)
            ->get();

        foreach ($deleteContentTags as $deleteContentTag) {
            $deleteContentTag->delete();
        }

        if ($save) {
            for ($i = 0; $i < sizeOf($request->contentTagIds); $i++) {
                $question_content_tag = new QuestionContentTag();
                $question_content_tag->exam_type = $exam->exam_type.' MCQ';
                $question_content_tag->question_id = $mcq->id;
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

    public function destroy(Exam $exam, $pop_quiz_mcq_slug)
    {
        $mcq = PopQuizMCQ::where('slug', $pop_quiz_mcq_slug)->firstOrFail();

        $question_content_tags = QuestionContentTag::where("exam_type", $exam->exam_type.' MCQ')->where('question_id', $mcq->id)->get();

        foreach($question_content_tags as $question_content_tag){
            $question_content_tag->delete();
        }

        $delete = $mcq->delete();

        if ($delete) {
            return redirect()->route('exam.show', $exam)->with('status', 'Pop Quiz MCQ deleted successfully!');
        } else {
            return redirect()->route('exam.show', $exam)->with('failed', 'Pop Quiz MCQ deletion failed!');
        }
    }
}
