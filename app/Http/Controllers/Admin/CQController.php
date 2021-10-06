<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\CQ;
use App\Models\Admin\Exam;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\ContentTag;
use App\Http\Controllers\Controller;
use App\Models\Admin\CreativeQuestion;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\QuestionContentTag;
use App\Http\Controllers\Admin\ExamController;

class CQController extends Controller
{
    public function index(Exam $exam)
    {
        // $cqs = CQ::join('exams', 'c_q_s.exam_id', 'exams.id')
        //     ->select('c_q_s.*', 'exams.title as examTitle')
        //     ->where('exam_id', $exam->id)
        //     ->orderby('id', 'DESC')->get();
        $cqs = CreativeQuestion::where('exam_id', $exam->id)
            ->orderby('id', 'DESC')->get();
        // dd($creative_question);
        return view('admin.pages.cq.index', compact('cqs', 'exam'));
    }

    public function create()
    {
        // this function is written in exam controller named  addQuestion
        ExamController::addQuestion(); //ignore the error. If you want to see the code just press the Alt key and left mouse button
    }

    public function store(Request $request, Exam $exam)
    {
        // dd($request);
        $validateData = $request->validate([
            'creative_question' => 'required|min:4',
            'uddipokimage' => 'nullable|image|mimes:jpeg,jpg,png|max:4096',
            'answer' => 'required|mimes:pdf|max:10000',
            'examId' => 'required',
            'gyanmulokquestion' => 'required|min:4',
            'gyanmulokmarks' => 'required|numeric',
            'gyanmulokcontentTagIds' => 'required',
            'onudhabonquestion' => 'required|min:4',
            'onudhabonmarks' => 'required|numeric',
            'onudhaboncontentTagIds' => 'required',
            'proyugquestion' => 'required|min:4',
            'proyugmarks' => 'required|numeric',
            'proyugcontentTagIds' => 'required',
            'ucchotorquestion' => 'required|min:4',
            'ucchotormarks' => 'required|numeric',
            'ucchotorcontentTagIds' => 'required'
        ]);

        $creative_question = new CreativeQuestion();
        $gyanmulok = new CQ();
        $onudhabon = new CQ();
        $proyug = new CQ();
        $ucchotor = new CQ();

        $creative_question->creative_question = $request->creative_question;
        $creative_question->slug = (string) Str::uuid();
        $creative_question->exam_id = $request->examId;
        if ($request->hasFile('uddipokimage')) {
            $creative_question->image = $request->uddipokimage->store('public/question/cq');
        }
        if ($request->hasFile('answer')) {
            $creative_question->standard_ans_pdf = $request->answer->store('public/question/cq/answer');
        }

        $saveCreativeQuestion = $creative_question->save();
        $creative_question_id = CreativeQuestion::latest()->first();

        $gyanmulok->question = $request->gyanmulokquestion;
        $gyanmulok->slug = (string) Str::uuid();
        $gyanmulok->marks = $request->gyanmulokmarks;
        $gyanmulok->creative_question_id = $creative_question_id->id;
        $gyanmulok->number_of_attempt = 0;
        $gyanmulok->gain_marks = 0;
        $gyanmulok->success_rate = 0;
        if ($request->hasFile('gyanmulokimage')) {
            $gyanmulok->image = $request->gyanmulokimage->store('public/question/cq');
        }

        $savegyanmulok = $gyanmulok->save();

        $question_id1 = CQ::latest()->first();

        if ($savegyanmulok) {
            if (!empty($request->gyanmulokcontentTagIds)) {
                for ($i = 0; $i < sizeOf($request->gyanmulokcontentTagIds); $i++) {
                    $question_content_tag1 = new QuestionContentTag();
                    $question_content_tag1->exam_type = 'CQ';
                    $question_content_tag1->question_id = $question_id1->id;
                    $question_content_tag1->content_tag_id = $request->gyanmulokcontentTagIds[$i];
                    $question_content_tag1->save();
                }
            }
        }

        // onudhabon
        $onudhabon->question = $request->onudhabonquestion;
        $onudhabon->slug = (string) Str::uuid();
        $onudhabon->marks = $request->onudhabonmarks;
        $onudhabon->creative_question_id = $creative_question_id->id;
        $onudhabon->number_of_attempt = 0;
        $onudhabon->gain_marks = 0;
        $onudhabon->success_rate = 0;
        if ($request->hasFile('onudhabonimage')) {
            $onudhabon->image = $request->onudhabonimage->store('public/question/cq');
        }

        $saveonudhabon = $onudhabon->save();

        $question_id2 = CQ::latest()->first();

        if ($saveonudhabon) {
            if (!empty($request->onudhaboncontentTagIds)) {
                for ($i = 0; $i < sizeOf($request->onudhaboncontentTagIds); $i++) {
                    $question_content_tag2 = new QuestionContentTag();
                    $question_content_tag2->exam_type = 'CQ';
                    $question_content_tag2->question_id = $question_id2->id;
                    $question_content_tag2->content_tag_id = $request->onudhaboncontentTagIds[$i];
                    $question_content_tag2->save();
                }
            }
        }

        // proyug
        $proyug->question = $request->proyugquestion;
        $proyug->slug = (string) Str::uuid();
        $proyug->marks = $request->proyugmarks;
        $proyug->creative_question_id = $creative_question_id->id;
        $proyug->number_of_attempt = 0;
        $proyug->gain_marks = 0;
        $proyug->success_rate = 0;
        if ($request->hasFile('proyugimage')) {
            $proyug->image = $request->proyugimage->store('public/question/cq');
        }

        $saveproyug = $proyug->save();

        $question_id3 = CQ::latest()->first();

        if ($saveproyug) {
            if (!empty($request->proyugcontentTagIds)) {
                for ($i = 0; $i < sizeOf($request->proyugcontentTagIds); $i++) {
                    $question_content_tag3 = new QuestionContentTag();
                    $question_content_tag3->exam_type = 'CQ';
                    $question_content_tag3->question_id = $question_id3->id;
                    $question_content_tag3->content_tag_id = $request->proyugcontentTagIds[$i];
                    $question_content_tag3->save();
                }
            }
        }

        // ucchotor
        $ucchotor->question = $request->ucchotorquestion;
        $ucchotor->slug = (string) Str::uuid();
        $ucchotor->marks = $request->ucchotormarks;
        $ucchotor->creative_question_id = $creative_question_id->id;
        $ucchotor->number_of_attempt = 0;
        $ucchotor->gain_marks = 0;
        $ucchotor->success_rate = 0;
        if ($request->hasFile('ucchotorimage')) {
            $ucchotor->image = $request->ucchotorimage->store('public/question/cq');
        }

        $saveucchotor = $ucchotor->save();

        $question_id = CQ::latest()->first();

        if ($saveucchotor) {
            if (!empty($request->ucchotorcontentTagIds)) {
                for ($i = 0; $i < sizeOf($request->ucchotorcontentTagIds); $i++) {
                    $question_content_tag = new QuestionContentTag();
                    $question_content_tag->exam_type = 'CQ';
                    $question_content_tag->question_id = $question_id->id;
                    $question_content_tag->content_tag_id = $request->ucchotorcontentTagIds[$i];
                    $question_content_tag->save();
                }
            }
        }

        session()->flash('status', 'CQ created successfully!');
        return redirect()->route('exam.show', $request->slug);
    }

    public function show(Exam $exam, CQ $cq)
    {
        $exam = Exam::where('id', $cq->exam_id)->select('title')->first();
        return view('admin.pages.cq.details', compact('cq', 'exam'));
    }

    public function edit(Exam $exam, CQ $cq)
    {
        $tagId = [];
        // $exam = Exam::where('id', $cq->exam_id)->first();
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

    public function update(Request $request, Exam $exam, CQ $cq)
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

    public function destroy(Exam $exam, CQ $cq)
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
