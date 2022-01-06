<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

 //models
 use App\Models\Admin\PopQuizMCQ;
 use App\Models\Admin\QuestionContentTag;
 use App\Models\Admin\Exam;
 use App\Models\Admin\ContentTag;

class PopQuizMCQController extends Controller
{
    public function index(Exam $exam)
    {
        $pop_quiz_mcqs = PopQuizMCQ::join('exams', 'pop_quiz_mcqs.exam_id', 'exams.id')
        ->select('pop_quiz_mcqs.*', 'exams.title as examTitle')
        ->where('exam_id', $exam->id)
        ->orderby('id', 'DESC')->get();

        return view('admin.pages.mcq_and_cq.index_mcq', compact('pop_quiz_mcqs', 'exam'));
    }

    public function store(Request $request)
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

        $pop_quiz_mcqs = new PopQuizMCQ();
        $pop_quiz_mcqs->question = $request['question'];
        $pop_quiz_mcqs->slug = (string) Str::uuid();
        if ($request->hasFile('image')) {
            $pop_quiz_mcqs->image = $request->image->store('public/question/pop_quiz_mcqs');
            $pop_quiz_mcqs->image = Storage::url($pop_quiz_mcqs->image);
        }
        $pop_quiz_mcqs->field1 = $request['field1'];
        $pop_quiz_mcqs->field2 = $request['field2'];
        $pop_quiz_mcqs->field3 = $request['field3'];
        $pop_quiz_mcqs->field4 = $request['field4'];
        $pop_quiz_mcqs->answer = $request['answer'];
        $pop_quiz_mcqs->exam_id = $request->examId;
        $pop_quiz_mcqs->explanation = $request['explanation'];
        $pop_quiz_mcqs->number_of_attempt = 0;
        $pop_quiz_mcqs->gain_marks = 0;
        $pop_quiz_mcqs->success_rate = 0;

        $save = $pop_quiz_mcqs->save();

        // dd($pop_quiz_mcqs);

        if ($save) {
            for ($i = 0; $i < sizeOf($request->contentTagIds); $i++) {
                $question_content_tag = new QuestionContentTag();
                $question_content_tag->exam_type = 'Pop Quiz';
                $question_content_tag->question_id = $pop_quiz_mcqs->id;
                $question_content_tag->content_tag_id = $request->contentTagIds[$i];
                // dd($question_content_tag);
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
        dd("PopQuizMCQController Show Hit");
        $exam = Exam::where('id', $pop_quiz_mcq->exam_id)->first();
        return view('admin.pages.aptitude_test.details', compact('pop_quiz_mcq', 'exam'));
    }

    public function edit(Exam $exam, PopQuizMCQ $pop_quiz_mcq)
    {
        dd("PopQuizMCQController Edit Hit");
        $tagId = [];
        // $exam = Exam::where('id', $pop_quiz_mcq->exam_id)->first();
        $questionContentTags = QuestionContentTag::where('exam_type', "Aptitude Test")
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

        return view('admin.pages.aptitude_test.edit', compact('pop_quiz_mcq', 'exam', 'contentTags', 'questionContentTags'));
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

        // dump($pop_quiz_mcq);
        // $pop_quiz_mcq = PopQuizMCQ::find($pop_quiz_mcq->id);

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

        // dd($pop_quiz_mcq);

        $save = $pop_quiz_mcq->save();

        $deleteContentTags = QuestionContentTag::where('exam_type', "Aptitude Test")
            ->where('question_id', $pop_quiz_mcq->id)
            ->get();
        foreach ($deleteContentTags as $deleteContentTag) {
            $delete = $deleteContentTag->delete();
        }

        if ($save) {
            for ($i = 0; $i < sizeOf($request->contentTagIds); $i++) {
                $question_content_tag = new QuestionContentTag();
                $question_content_tag->exam_type = 'Aptitude Test';
                $question_content_tag->question_id = $pop_quiz_mcq->id;
                $question_content_tag->content_tag_id = $request->contentTagIds[$i];
                $question_content_tag->save();
            }
            session()->flash('status', 'Aptitude Test MCQ edited successfully!');
            return redirect()->route('exam.show', $request->slug);
        } else {
            session()->flash('failed', 'Aptitude Test MCQ edit failed!');
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
            return redirect()->route('exam.show', $exam)->with('status', 'Aptitude Test MCQ deleted successfully!');
        } else {
            return redirect()->route('exam.show', $exam)->with('failed', 'Aptitude Test MCQ deletion failed!');
        }
    }
}
