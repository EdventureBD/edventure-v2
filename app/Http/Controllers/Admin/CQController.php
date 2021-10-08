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
        // dd($cqs);
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

        // জ্ঞানমূলক
        $gyanmulok = new CQ();
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
        if ($savegyanmulok) {
            $question_id1 = CQ::latest('id')->first();
            if ($question_id1) {
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
        }

        // অনুধাবন
        $onudhabon = new CQ();
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
        if ($saveonudhabon) {
            $question_id2 = CQ::latest('id')->first();
            if ($question_id2) {
                if (!empty($request->onudhaboncontentTagIds)) {
                    for ($j = 0; $j < sizeOf($request->onudhaboncontentTagIds); $j++) {
                        $question_content_tag2 = new QuestionContentTag();
                        $question_content_tag2->exam_type = 'CQ';
                        $question_content_tag2->question_id = $question_id2->id;
                        $question_content_tag2->content_tag_id = $request->onudhaboncontentTagIds[$j];
                        $question_content_tag2->save();
                    }
                }
            }
        }

        // প্রয়োগমূলক
        $proyug = new CQ();
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
        if ($saveproyug) {
            $question_id3 = CQ::latest('id')->first();
            if ($question_id3) {
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
        }

        // উচ্চতর দক্ষতা
        $ucchotor = new CQ();
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
        if ($saveucchotor) {
            $question_id4 = CQ::latest('id')->first();
            if ($question_id4) {
                if (!empty($request->ucchotorcontentTagIds)) {
                    for ($i = 0; $i < sizeOf($request->ucchotorcontentTagIds); $i++) {
                        $question_content_tag4 = new QuestionContentTag();
                        $question_content_tag4->exam_type = 'CQ';
                        $question_content_tag4->question_id = $question_id4->id;
                        $question_content_tag4->content_tag_id = $request->ucchotorcontentTagIds[$i];
                        $question_content_tag4->save();
                    }
                }
            }
        }

        session()->flash('status', 'CQ created successfully!');
        return redirect()->route('exam.show', $request->slug);
    }

    public function show(Exam $exam, CreativeQuestion $cq)
    {
        // dd($cq);
        return view('admin.pages.cq.details', compact('cq', 'exam'));
    }

    public function edit(Exam $exam, CreativeQuestion $cq)
    {
        // dd($cq->id);
        $cquestion1 = CreativeQuestion::find($cq->id)->question()->where('marks', 1)->first(); // জ্ঞানমূলক
        $cquestion2 = CreativeQuestion::find($cq->id)->question()->where('marks', 2)->first(); // অনুধাবন
        $cquestion3 = CreativeQuestion::find($cq->id)->question()->where('marks', 3)->first(); // প্রয়োগমূলক
        $cquestion4 = CreativeQuestion::find($cq->id)->question()->where('marks', 4)->first(); // উচ্চতর দক্ষতা
        $tagId1 = []; // জ্ঞানমূলক
        $tagId2 = []; // অনুধাবন
        $tagId3 = []; // প্রয়োগমূলক
        $tagId4 = []; // উচ্চতর দক্ষতা

        // dd($cquestion1, $cquestion2, $cquestion3, $cquestion4);
        // জ্ঞানমূলক
        $questionContentTags1 = QuestionContentTag::where('exam_type', "CQ")
            ->where('question_id', $cquestion1->id)
            ->get();
        foreach ($questionContentTags1 as $qct) {
            array_push($tagId1, $qct->content_tag_id);
        }
        $contentTags1 = ContentTag::where('course_id', $exam->course_id)
            ->where('topic_id', $exam->topic_id)
            ->whereNotIn('id', $tagId1)
            ->get();
        // dd($questionContentTags1, $contentTags1);

        // অনুধাবন
        $questionContentTags2 = QuestionContentTag::where('exam_type', "CQ")
            ->where('question_id', $cquestion2->id)
            ->get();
        foreach ($questionContentTags2 as $qct) {
            array_push($tagId2, $qct->content_tag_id);
        }
        $contentTags2 = ContentTag::where('course_id', $exam->course_id)
            ->where('topic_id', $exam->topic_id)
            ->whereNotIn('id', $tagId2)
            ->get();

        // dd($questionContentTags2, $contentTags2);
        // প্রয়োগমূলক
        $questionContentTags3 = QuestionContentTag::where('exam_type', "CQ")
            ->where('question_id', $cquestion3->id)
            ->get();
        foreach ($questionContentTags3 as $qct) {
            array_push($tagId3, $qct->content_tag_id);
        }
        $contentTags3 = ContentTag::where('course_id', $exam->course_id)
            ->where('topic_id', $exam->topic_id)
            ->whereNotIn('id', $tagId3)
            ->get();

        // dd($questionContentTags3, $contentTags3);
        // উচ্চতর দক্ষতা
        $questionContentTags4 = QuestionContentTag::where('exam_type', "CQ")
            ->where('question_id', $cquestion4->id)
            ->get();
        foreach ($questionContentTags4 as $qct) {
            array_push($tagId4, $qct->content_tag_id);
        }
        $contentTags4 = ContentTag::where('course_id', $exam->course_id)
            ->where('topic_id', $exam->topic_id)
            ->whereNotIn('id', $tagId4)
            ->get();

        // dd($questionContentTags4, $contentTags4);
        return view('admin.pages.cq.edit', compact(
            'cq',
            'exam',
            'contentTags1',
            'questionContentTags1',
            'contentTags2',
            'questionContentTags2',
            'contentTags3',
            'questionContentTags3',
            'contentTags4',
            'questionContentTags4',
            'cquestion1',
            'cquestion2',
            'cquestion3',
            'cquestion4',
        ));
    }

    public function update(Request $request, Exam $exam, CreativeQuestion $cq)
    {
        // dd($request);
        $validateData = $request->validate([
            'creative_question' => 'required|min:4',
            'uddipokimage' => 'nullable|image|mimes:jpeg,jpg,png|max:4096',
            'answer' => 'nullable|mimes:pdf|max:10000',
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

        $cq->creative_question = $request->creative_question;
        $cq->slug = (string) Str::uuid();
        $cq->exam_id = $request->examId;
        if ($request->hasFile('uddipokimage')) {
            Storage::delete('public/question/cq' . $cq->image);
            $cq->image = $request->uddipokimage->store('public/question/cq');
        }
        if ($request->hasFile('answer')) {
            Storage::delete('public/question/cq/answer' . $cq->standard_ans_pdf);
            $cq->standard_ans_pdf = $request->answer->store('public/question/cq/answer');
        }

        $saveCreativeQuestion = $cq->save();
        $creative_question_id = CreativeQuestion::latest()->first();

        // জ্ঞানমূলক
        $gyanmulok = CQ::where('creative_question_id', $cq->id)->where('marks', 1)->first();
        $gyanmulok->question = $request->gyanmulokquestion;
        $gyanmulok->slug = (string) Str::uuid();
        $gyanmulok->marks = $request->gyanmulokmarks;
        $gyanmulok->creative_question_id = $creative_question_id->id;
        $gyanmulok->number_of_attempt = 0;
        $gyanmulok->gain_marks = 0;
        $gyanmulok->success_rate = 0;
        if ($request->hasFile('gyanmulokimage')) {
            Storage::delete('public/question/cq' . $gyanmulok->image);
            $gyanmulok->image = $request->gyanmulokimage->store('public/question/cq');
        }

        $savegyanmulok = $gyanmulok->save();

        $deleteContentTags = QuestionContentTag::where('exam_type', "CQ")
            ->where('question_id', $gyanmulok->id)
            ->get();

        foreach ($deleteContentTags as $deleteContentTag) {
            $delete = $deleteContentTag->delete();
        }

        if ($savegyanmulok) {
            if (!empty($request->gyanmulokcontentTagIds)) {
                for ($i = 0; $i < sizeOf($request->gyanmulokcontentTagIds); $i++) {
                    $question_content_tag1 = new QuestionContentTag();
                    $question_content_tag1->exam_type = 'CQ';
                    $question_content_tag1->question_id = $gyanmulok->id;
                    $question_content_tag1->content_tag_id = $request->gyanmulokcontentTagIds[$i];
                    $question_content_tag1->save();
                }
            }
        }

        // অনুধাবন
        $onudhabon = CQ::where('creative_question_id', $cq->id)->where('marks', 2)->first();
        $onudhabon->question = $request->onudhabonquestion;
        $onudhabon->slug = (string) Str::uuid();
        $onudhabon->marks = $request->onudhabonmarks;
        $onudhabon->creative_question_id = $creative_question_id->id;
        $onudhabon->number_of_attempt = 0;
        $onudhabon->gain_marks = 0;
        $onudhabon->success_rate = 0;
        if ($request->hasFile('onudhabonimage')) {
            Storage::delete('public/question/cq' . $onudhabon->image);
            $onudhabon->image = $request->onudhabonimage->store('public/question/cq');
        }

        $saveonudhabon = $onudhabon->save();

        $deleteContentTags = QuestionContentTag::where('exam_type', "CQ")
            ->where('question_id', $onudhabon->id)
            ->get();

        foreach ($deleteContentTags as $deleteContentTag) {
            $delete = $deleteContentTag->delete();
        }

        if ($saveonudhabon) {
            if (!empty($request->onudhaboncontentTagIds)) {
                for ($j = 0; $j < sizeOf($request->onudhaboncontentTagIds); $j++) {
                    $question_content_tag2 = new QuestionContentTag();
                    $question_content_tag2->exam_type = 'CQ';
                    $question_content_tag2->question_id = $onudhabon->id;
                    $question_content_tag2->content_tag_id = $request->onudhaboncontentTagIds[$j];
                    $question_content_tag2->save();
                }
            }
        }

        // প্রয়োগমূলক
        $proyug = CQ::where('creative_question_id', $cq->id)->where('marks', 3)->first();
        $proyug->question = $request->proyugquestion;
        $proyug->slug = (string) Str::uuid();
        $proyug->marks = $request->proyugmarks;
        $proyug->creative_question_id = $creative_question_id->id;
        $proyug->number_of_attempt = 0;
        $proyug->gain_marks = 0;
        $proyug->success_rate = 0;
        if ($request->hasFile('proyugimage')) {
            Storage::delete('public/question/cq' . $proyug->image);
            $proyug->image = $request->proyugimage->store('public/question/cq');
        }

        $saveproyug = $proyug->save();

        $deleteContentTags = QuestionContentTag::where('exam_type', "CQ")
            ->where('question_id', $proyug->id)
            ->get();

        foreach ($deleteContentTags as $deleteContentTag) {
            $delete = $deleteContentTag->delete();
        }

        if ($saveproyug) {
            if (!empty($request->proyugcontentTagIds)) {
                for ($i = 0; $i < sizeOf($request->proyugcontentTagIds); $i++) {
                    $question_content_tag3 = new QuestionContentTag();
                    $question_content_tag3->exam_type = 'CQ';
                    $question_content_tag3->question_id = $proyug->id;
                    $question_content_tag3->content_tag_id = $request->proyugcontentTagIds[$i];
                    $question_content_tag3->save();
                }
            }
        }

        // উচ্চতর দক্ষতা
        $ucchotor = CQ::where('creative_question_id', $cq->id)->where('marks', 4)->first();
        $ucchotor->question = $request->ucchotorquestion;
        $ucchotor->slug = (string) Str::uuid();
        $ucchotor->marks = $request->ucchotormarks;
        $ucchotor->creative_question_id = $creative_question_id->id;
        $ucchotor->number_of_attempt = 0;
        $ucchotor->gain_marks = 0;
        $ucchotor->success_rate = 0;
        if ($request->hasFile('ucchotorimage')) {
            Storage::delete('public/question/cq' . $ucchotor->image);
            $ucchotor->image = $request->ucchotorimage->store('public/question/cq');
        }

        $saveucchotor = $ucchotor->save();

        $deleteContentTags = QuestionContentTag::where('exam_type', "CQ")
            ->where('question_id', $ucchotor->id)
            ->get();

        foreach ($deleteContentTags as $deleteContentTag) {
            $delete = $deleteContentTag->delete();
        }

        if ($saveucchotor) {
            if (!empty($request->ucchotorcontentTagIds)) {
                for ($i = 0; $i < sizeOf($request->ucchotorcontentTagIds); $i++) {
                    $question_content_tag4 = new QuestionContentTag();
                    $question_content_tag4->exam_type = 'CQ';
                    $question_content_tag4->question_id = $ucchotor->id;
                    $question_content_tag4->content_tag_id = $request->ucchotorcontentTagIds[$i];
                    $question_content_tag4->save();
                }
            }
        }
        session()->flash('status', 'CQ updateds successfully!');
        return redirect()->route('exam.show', $request->slug);
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


// public function edit(Exam $exam, CreativeQuestion $cq)
//     {
//         $tagId = [];
//         $questionContentTags = QuestionContentTag::where('exam_type', "CQ")
//             ->where('question_id', $cq->id)
//             ->get();
//         foreach ($questionContentTags as $qct) {
//             array_push($tagId, $qct->content_tag_id);
//         }
//         $contentTags = ContentTag::where('course_id', $exam->course_id)
//             ->where('topic_id', $exam->topic_id)
//             ->whereNotIn('id', $tagId)
//             ->get();
//         return view('admin.pages.cq.edit', compact('cq', 'exam', 'contentTags', 'questionContentTags'));
//}