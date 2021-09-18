<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\CQ;
use App\Models\Admin\Exam;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\ContentTag;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\QuestionContentTag;
use App\Http\Controllers\Admin\ExamController;

class CQController extends Controller
{
    public function index()
    {
        $cqs = CQ::join('exams', 'c_q_s.exam_id', 'exams.id')
            ->select('c_q_s.*', 'exams.title as examTitle')
            ->get();
        return view('admin.pages.cq.index', compact('cqs'));
    }

    public function create()
    {
        // this function is written in exam controller named  addQuestion
        ExamController::addQuestion(); //ignore the error. If you want to see the code just press the Alt key and left mouse button
    }

    public function store(Request $request, Exam $exam)
    {
        $validateData = $request->validate([
            'question' => 'required|min:4|unique:c_q_s',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:4096',
            'answer' => 'required|mimes:pdf|max:10000',
            'examId' => 'required',
            'marks' => 'required|numeric'
        ]);

        $cq = new CQ();

        if ($request->hasFile('image')) {
            $cq->image = $request->image->store('public/question/cq');
        }

        if ($request->hasFile('answer')) {
            $cq->standard_ans_pdf = $request->answer->store('public/question/cq/answer');
        }

        $cq->question = $request['question'];
        $cq->slug = Str::slug($request['question']);
        $cq->marks = $request['marks'];
        $cq->exam_id = $request['examId'];
        $cq->number_of_attempt = 0;
        $cq->gain_marks = 0;
        $cq->success_rate = 0;

        $save = $cq->save();

        $question_id = CQ::latest()->first();

        if ($save) {
            if (!empty($request->contentTagIds)) {
                for ($i = 0; $i < sizeOf($request->contentTagIds); $i++) {
                    $question_content_tag = new QuestionContentTag();
                    $question_content_tag->exam_type = 'CQ';
                    $question_content_tag->question_id = $question_id->id;
                    $question_content_tag->content_tag_id = $request->contentTagIds[$i];
                    $question_content_tag->save();
                }
            }
            session()->flash('status', 'CQ created successfully!');
            return redirect()->route('exam.show', $request->slug);
        } else {
            session()->flash('failed', 'CQ creation failed!');
            return redirect()->route('addQuestion');
        }
        return view('admin.pages.cq.create');
    }

    public function show(CQ $cq)
    {
        $exam = Exam::where('id', $cq->exam_id)->select('title')->first();
        return view('admin.pages.cq.details', compact('cq', 'exam'));
    }

    public function edit(CQ $cq)
    {
        $tagId = [];
        $exam = Exam::where('id', $cq->exam_id)->first();
        $questionContentTags = QuestionContentTag::where('exam_type', "CQ")
            ->where('question_id', $cq->id)
            ->get();
        foreach ($questionContentTags as $qct) {
            array_push($tagId, $qct->content_tag_id);
        }
        $contentTags = ContentTag::where('course_id', $exam->course_id)
            ->where('topic_id', $exam->topic_id)
            ->whereNotIn('id', $tagId)
            ->get();
        return view('admin.pages.cq.edit', compact('cq', 'exam', 'contentTags', 'questionContentTags'));
    }

    public function update(Request $request, CQ $cq)
    {
        $validateData = $request->validate([
            'question' => 'required|min:4',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:4096',
            'examId' => 'required',
            'marks' => 'required|numeric'
        ]);

        $cq = CQ::find($cq->id);

        if ($request->hasFile('image')) {
            if ($cq->image) {
                Storage::delete($cq->image);
            }
            $cq->image = $request->image->store('public/question/cq');
        }

        if ($request->hasFile('answer')) {
            $cq->standard_ans_pdf = $request->answer->store('public/question/cq/answer');
        }

        $cq->question = $request['question'];
        $cq->slug = Str::slug($request['question']);
        $cq->marks = $request['marks'];
        $cq->exam_id = $request['examId'];
        $cq->number_of_attempt = 0;
        $cq->gain_marks = 0;
        $cq->success_rate = 0;

        $save = $cq->save();

        $deleteContentTags = QuestionContentTag::where('exam_type', "CQ")
            ->where('question_id', $cq->id)
            ->get();

        foreach ($deleteContentTags as $deleteContentTag) {
            $delete = $deleteContentTag->delete();
        }

        if ($save) {
            if (!empty($request->contentTagIds)) {
                for ($i = 0; $i < sizeOf($request->contentTagIds); $i++) {
                    $question_content_tag = new QuestionContentTag();
                    $question_content_tag->exam_type = 'CQ';
                    $question_content_tag->question_id = $cq->id;
                    $question_content_tag->content_tag_id = $request->contentTagIds[$i];
                    $question_content_tag->save();
                }
            }
            session()->flash('status', 'CQ created successfully!');
            return redirect()->route('exam.show', $request->slug);
        } else {
            session()->flash('failed', 'CQ creation failed!');
            return redirect()->route('addQuestion');
        }
        return view('admin.pages.cq.create');
    }

    public function destroy(CQ $cq)
    {
        $exam = Exam::where('id', $cq->exam_id)->first();
        $delete = $cq->delete();
        if ($delete) {
            return redirect()->route('exam.show', $exam)->with('status', 'CQ deleted successfully!');
        } else {
            return redirect()->route('exam.show', $exam)->with('failed', 'CQ deletion failed!');
        }
    }
}
