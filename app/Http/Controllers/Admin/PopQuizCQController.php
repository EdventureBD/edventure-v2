<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// support classes
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

// models
use App\Models\Admin\QuestionContentTag;
use App\Models\Admin\ContentTag;
use App\Models\Admin\Exam;
use App\Models\Admin\PopQuizCreativeQuestion;
use App\Models\Admin\PopQuizCQ;

class PopQuizCQController extends Controller
{
    // public function index(Exam $exam)
    // {
    //     dd("Pop Quiz PopQuizCQ Controller Index");
    //     // $cqs = PopQuizCQ::join('exams', 'c_q_s.exam_id', 'exams.id')
    //     //     ->select('c_q_s.*', 'exams.title as examTitle')
    //     //     ->where('exam_id', $exam->id)
    //     //     ->orderby('id', 'DESC')->get();
    //     $cqs = PopQuizCreativeQuestion::where('exam_id', $exam->id)
    //         ->orderby('id', 'DESC')->get();
    //     // dd($cqs);
    //     return view('admin.pages.cq.index', compact('cqs', 'exam'));
    // }

    public function store(Request $request, Exam $exam)
    {
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

        $creative_question = new PopQuizCreativeQuestion();

        $creative_question->creative_question = $request->creative_question;
        $creative_question->slug = (string) Str::uuid();
        $creative_question->exam_id = $request->examId;
        if ($request->hasFile('uddipokimage')) {
            $creative_question->image = $request->uddipokimage->store('public/question/pop_quiz_cq');
        }
        if ($request->hasFile('answer')) {
            $creative_question->standard_ans_pdf = $request->answer->store('public/question/pop_quiz_cq/answer');
        }

        $creative_question->save();

        // জ্ঞানমূলক
        $gyanmulok = new PopQuizCQ();
        $gyanmulok->question = $request->gyanmulokquestion;
        $gyanmulok->slug = (string) Str::uuid();
        $gyanmulok->marks = $request->gyanmulokmarks;
        $gyanmulok->creative_question_id = $creative_question->id;
        $gyanmulok->number_of_attempt = 0;
        $gyanmulok->gain_marks = 0;
        $gyanmulok->success_rate = 0;
        if ($request->hasFile('gyanmulokimage')) {
            $gyanmulok->image = $request->gyanmulokimage->store('public/question/pop_quiz_cq');
        }

        $savegyanmulok = $gyanmulok->save();
        if ($savegyanmulok) {
            if (!empty($request->gyanmulokcontentTagIds)) {
                for ($i = 0; $i < sizeOf($request->gyanmulokcontentTagIds); $i++) {
                    $question_content_tag1 = new QuestionContentTag();
                    $question_content_tag1->exam_type = $exam->exam_type.' CQ';
                    $question_content_tag1->question_id = $gyanmulok->id;
                    $question_content_tag1->content_tag_id = $request->gyanmulokcontentTagIds[$i];
                    $question_content_tag1->save();
                }
            }
        }

        // অনুধাবন
        $onudhabon = new PopQuizCQ();
        $onudhabon->question = $request->onudhabonquestion;
        $onudhabon->slug = (string) Str::uuid();
        $onudhabon->marks = $request->onudhabonmarks;
        $onudhabon->creative_question_id = $creative_question->id;
        $onudhabon->number_of_attempt = 0;
        $onudhabon->gain_marks = 0;
        $onudhabon->success_rate = 0;
        if ($request->hasFile('onudhabonimage')) {
            $onudhabon->image = $request->onudhabonimage->store('public/question/pop_quiz_cq');
        }

        $saveonudhabon = $onudhabon->save();
        if ($saveonudhabon) {
            if (!empty($request->onudhaboncontentTagIds)) {
                for ($j = 0; $j < sizeOf($request->onudhaboncontentTagIds); $j++) {
                    $question_content_tag2 = new QuestionContentTag();
                    $question_content_tag2->exam_type = $exam->exam_type.' CQ';
                    $question_content_tag2->question_id = $onudhabon->id;
                    $question_content_tag2->content_tag_id = $request->onudhaboncontentTagIds[$j];
                    $question_content_tag2->save();
                }
            }
        }

        // প্রয়োগমূলক
        $proyug = new PopQuizCQ();
        $proyug->question = $request->proyugquestion;
        $proyug->slug = (string) Str::uuid();
        $proyug->marks = $request->proyugmarks;
        $proyug->creative_question_id = $creative_question->id;
        $proyug->number_of_attempt = 0;
        $proyug->gain_marks = 0;
        $proyug->success_rate = 0;
        if ($request->hasFile('proyugimage')) {
            $proyug->image = $request->proyugimage->store('public/question/pop_quiz_cq');
        }

        $saveproyug = $proyug->save();
        if ($saveproyug) {
            if (!empty($request->proyugcontentTagIds)) {
                for ($i = 0; $i < sizeOf($request->proyugcontentTagIds); $i++) {
                    $question_content_tag3 = new QuestionContentTag();
                    $question_content_tag3->exam_type = $exam->exam_type.' CQ';
                    $question_content_tag3->question_id = $proyug->id;
                    $question_content_tag3->content_tag_id = $request->proyugcontentTagIds[$i];
                    $question_content_tag3->save();
                }
            }
        }

        // উচ্চতর দক্ষতা
        $ucchotor = new PopQuizCQ();
        $ucchotor->question = $request->ucchotorquestion;
        $ucchotor->slug = (string) Str::uuid();
        $ucchotor->marks = $request->ucchotormarks;
        $ucchotor->creative_question_id = $creative_question->id;
        $ucchotor->number_of_attempt = 0;
        $ucchotor->gain_marks = 0;
        $ucchotor->success_rate = 0;
        if ($request->hasFile('ucchotorimage')) {
            $ucchotor->image = $request->ucchotorimage->store('public/question/pop_quiz_cq');
        }

        $saveucchotor = $ucchotor->save();
        if ($saveucchotor) {
            if (!empty($request->ucchotorcontentTagIds)) {
                for ($i = 0; $i < sizeOf($request->ucchotorcontentTagIds); $i++) {
                    $question_content_tag4 = new QuestionContentTag();
                    $question_content_tag4->exam_type = $exam->exam_type.' CQ';
                    $question_content_tag4->question_id = $ucchotor->id;
                    $question_content_tag4->content_tag_id = $request->ucchotorcontentTagIds[$i];
                    $question_content_tag4->save();
                }
            }
        }

        session()->flash('status', 'Pop Quiz CQ created successfully!');
        return redirect()->route('exam.show', $request->slug);
    }

    public function show(Exam $exam, $pop_quiz_cq_slug)
    {
        $cq = PopQuizCreativeQuestion::where('slug', $pop_quiz_cq_slug)->firstOrFail();

        $cquestion1 = $cq->question()->where('marks', 1)->first(); // জ্ঞানমূলক
        $cquestion2 = $cq->question()->where('marks', 2)->first(); // অনুধাবন
        $cquestion3 = $cq->question()->where('marks', 3)->first(); // প্রয়োগমূলক
        $cquestion4 = $cq->question()->where('marks', 4)->first(); // উচ্চতর দক্ষতা
        $questionContentTags1 = QuestionContentTag::where('exam_type', $exam->exam_type.' CQ')
            ->where('question_id', $cquestion1->id)
            ->get();
        $questionContentTags2 = QuestionContentTag::where('exam_type', $exam->exam_type.' CQ')
            ->where('question_id', $cquestion2->id)
            ->get();
        $questionContentTags3 = QuestionContentTag::where('exam_type', $exam->exam_type.' CQ')
            ->where('question_id', $cquestion3->id)
            ->get();
        $questionContentTags4 = QuestionContentTag::where('exam_type', $exam->exam_type.' CQ')
            ->where('question_id', $cquestion4->id)
            ->get();

        $type = "Pop Quiz";

        return view('admin.pages.mcq_and_cq.details_cq', compact(
            'cq',
            'exam',
            'cquestion1',
            'cquestion2',
            'cquestion3',
            'cquestion4',
            'questionContentTags1',
            'questionContentTags2',
            'questionContentTags3',
            'questionContentTags4',
            'type',
        ));
    }

    public function edit(Exam $exam, $pop_quiz_cq_slug)
    {
        $cq = PopQuizCreativeQuestion::where('slug', $pop_quiz_cq_slug)->firstOrFail();

        $cquestion1 = $cq->question()->where('marks', 1)->first(); // জ্ঞানমূলক
        $cquestion2 = $cq->question()->where('marks', 2)->first(); // অনুধাবন
        $cquestion3 = $cq->question()->where('marks', 3)->first(); // প্রয়োগমূলক
        $cquestion4 = $cq->question()->where('marks', 4)->first(); // উচ্চতর দক্ষতা
        $tagId1 = []; // জ্ঞানমূলক
        $tagId2 = []; // অনুধাবন
        $tagId3 = []; // প্রয়োগমূলক
        $tagId4 = []; // উচ্চতর দক্ষতা

        // জ্ঞানমূলক
        $questionContentTags1 = QuestionContentTag::where('exam_type', $exam->exam_type.' CQ')
            ->where('question_id', $cquestion1->id)
            ->get();
        foreach ($questionContentTags1 as $qct) {
            array_push($tagId1, $qct->content_tag_id);
        }
        if ($exam->special == 1) {
            $contentTags1 = ContentTag::where('course_id', $exam->course_id)
                ->whereNotIn('id', $tagId1)
                ->get();
        } else {
            $contentTags1 = ContentTag::where('course_id', $exam->course_id)
                ->where('topic_id', $exam->topic_id)
                ->whereNotIn('id', $tagId1)
                ->get();
        }

        // অনুধাবন
        $questionContentTags2 = QuestionContentTag::where('exam_type', $exam->exam_type.' CQ')
            ->where('question_id', $cquestion2->id)
            ->get();
        foreach ($questionContentTags2 as $qct) {
            array_push($tagId2, $qct->content_tag_id);
        }
        if ($exam->special == 1) {
            $contentTags2 = ContentTag::where('course_id', $exam->course_id)
                ->whereNotIn('id', $tagId2)
                ->get();
        } else {
            $contentTags2 = ContentTag::where('course_id', $exam->course_id)
                ->where('topic_id', $exam->topic_id)
                ->whereNotIn('id', $tagId2)
                ->get();
        }

        // প্রয়োগমূলক
        $questionContentTags3 = QuestionContentTag::where('exam_type', $exam->exam_type.' CQ')
            ->where('question_id', $cquestion3->id)
            ->get();
        foreach ($questionContentTags3 as $qct) {
            array_push($tagId3, $qct->content_tag_id);
        }
        if ($exam->special == 1) {
            $contentTags3 = ContentTag::where('course_id', $exam->course_id)
                ->whereNotIn('id', $tagId3)
                ->get();
        } else {
            $contentTags3 = ContentTag::where('course_id', $exam->course_id)
                ->where('topic_id', $exam->topic_id)
                ->whereNotIn('id', $tagId3)
                ->get();
        }

        // উচ্চতর দক্ষতা
        $questionContentTags4 = QuestionContentTag::where('exam_type', $exam->exam_type.' CQ')
            ->where('question_id', $cquestion4->id)
            ->get();
        foreach ($questionContentTags4 as $qct) {
            array_push($tagId4, $qct->content_tag_id);
        }

        if ($exam->special == 1) {
            $contentTags4 = ContentTag::where('course_id', $exam->course_id)
                ->whereNotIn('id', $tagId4)
                ->get();
        } else {
            $contentTags4 = ContentTag::where('course_id', $exam->course_id)
                ->where('topic_id', $exam->topic_id)
                ->whereNotIn('id', $tagId4)
                ->get();
        }

        $type = "Pop Quiz";
        $update_route = 'pop-quiz-cq.update';

        return view('admin.pages.mcq_and_cq.edit_cq', compact(
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
            'type',
            'update_route',
        ));
    }

    public function update(Request $request, Exam $exam, $pop_quiz_cq_slug)
    {
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

        $creative_question = PopQuizCreativeQuestion::where('slug', $pop_quiz_cq_slug)->firstOrFail();

        $creative_question->creative_question = $request->creative_question;
        $creative_question->exam_id = $request->examId;
        if ($request->hasFile('uddipokimage')) {
            Storage::delete('public/question/pop_quiz_cq' . $creative_question->image);
            $creative_question->image = $request->uddipokimage->store('public/question/pop_quiz_cq');
        }
        if ($request->hasFile('answer')) {
            Storage::delete('public/question/pop_quiz_cq/answer' . $creative_question->standard_ans_pdf);
            $creative_question->standard_ans_pdf = $request->answer->store('public/question/pop_quiz_cq/answer');
        }

        $creative_question->save();

        // জ্ঞানমূলক
        $gyanmulok = PopQuizCQ::where('creative_question_id', $creative_question->id)->where('marks', 1)->first();
        $gyanmulok->question = $request->gyanmulokquestion;
        $gyanmulok->slug = (string) Str::uuid();
        $gyanmulok->marks = $request->gyanmulokmarks;
        $gyanmulok->creative_question_id = $creative_question->id;
        $gyanmulok->number_of_attempt = 0;
        $gyanmulok->gain_marks = 0;
        $gyanmulok->success_rate = 0;
        if ($request->hasFile('gyanmulokimage')) {
            Storage::delete('public/question/pop_quiz_cq' . $gyanmulok->image);
            $gyanmulok->image = $request->gyanmulokimage->store('public/question/pop_quiz_cq');
        }

        $savegyanmulok = $gyanmulok->save();

        $deleteContentTags = QuestionContentTag::where('exam_type', $exam->exam_type.' CQ')
            ->where('question_id', $gyanmulok->id)
            ->get();

        foreach ($deleteContentTags as $deleteContentTag) {
            $delete = $deleteContentTag->delete();
        }

        if ($savegyanmulok) {
            if (!empty($request->gyanmulokcontentTagIds)) {
                for ($i = 0; $i < sizeOf($request->gyanmulokcontentTagIds); $i++) {
                    $question_content_tag1 = new QuestionContentTag();
                    $question_content_tag1->exam_type = $exam->exam_type.' CQ';
                    $question_content_tag1->question_id = $gyanmulok->id;
                    $question_content_tag1->content_tag_id = $request->gyanmulokcontentTagIds[$i];
                    $question_content_tag1->save();
                }
            }
        }

        // অনুধাবন
        $onudhabon = PopQuizCQ::where('creative_question_id', $creative_question->id)->where('marks', 2)->first();
        $onudhabon->question = $request->onudhabonquestion;
        $onudhabon->slug = (string) Str::uuid();
        $onudhabon->marks = $request->onudhabonmarks;
        $onudhabon->creative_question_id = $creative_question->id;
        $onudhabon->number_of_attempt = 0;
        $onudhabon->gain_marks = 0;
        $onudhabon->success_rate = 0;
        if ($request->hasFile('onudhabonimage')) {
            Storage::delete('public/question/pop_quiz_cq' . $onudhabon->image);
            $onudhabon->image = $request->onudhabonimage->store('public/question/pop_quiz_cq');
        }

        $saveonudhabon = $onudhabon->save();

        $deleteContentTags = QuestionContentTag::where('exam_type', $exam->exam_type.' CQ')
            ->where('question_id', $onudhabon->id)
            ->get();

        foreach ($deleteContentTags as $deleteContentTag) {
            $delete = $deleteContentTag->delete();
        }

        if ($saveonudhabon) {
            if (!empty($request->onudhaboncontentTagIds)) {
                for ($j = 0; $j < sizeOf($request->onudhaboncontentTagIds); $j++) {
                    $question_content_tag2 = new QuestionContentTag();
                    $question_content_tag2->exam_type = $exam->exam_type.' CQ';
                    $question_content_tag2->question_id = $onudhabon->id;
                    $question_content_tag2->content_tag_id = $request->onudhaboncontentTagIds[$j];
                    $question_content_tag2->save();
                }
            }
        }

        // প্রয়োগমূলক
        $proyug = PopQuizCQ::where('creative_question_id', $creative_question->id)->where('marks', 3)->first();
        $proyug->question = $request->proyugquestion;
        $proyug->slug = (string) Str::uuid();
        $proyug->marks = $request->proyugmarks;
        $proyug->creative_question_id = $creative_question->id;
        $proyug->number_of_attempt = 0;
        $proyug->gain_marks = 0;
        $proyug->success_rate = 0;
        if ($request->hasFile('proyugimage')) {
            Storage::delete('public/question/pop_quiz_cq' . $proyug->image);
            $proyug->image = $request->proyugimage->store('public/question/pop_quiz_cq');
        }

        $saveproyug = $proyug->save();

        $deleteContentTags = QuestionContentTag::where('exam_type', $exam->exam_type.' CQ')
            ->where('question_id', $proyug->id)
            ->get();

        foreach ($deleteContentTags as $deleteContentTag) {
            $delete = $deleteContentTag->delete();
        }

        if ($saveproyug) {
            if (!empty($request->proyugcontentTagIds)) {
                for ($i = 0; $i < sizeOf($request->proyugcontentTagIds); $i++) {
                    $question_content_tag3 = new QuestionContentTag();
                    $question_content_tag3->exam_type = $exam->exam_type.' CQ';
                    $question_content_tag3->question_id = $proyug->id;
                    $question_content_tag3->content_tag_id = $request->proyugcontentTagIds[$i];
                    $question_content_tag3->save();
                }
            }
        }

        // উচ্চতর দক্ষতা
        $ucchotor = PopQuizCQ::where('creative_question_id', $creative_question->id)->where('marks', 4)->first();
        $ucchotor->question = $request->ucchotorquestion;
        $ucchotor->slug = (string) Str::uuid();
        $ucchotor->marks = $request->ucchotormarks;
        $ucchotor->creative_question_id = $creative_question->id;
        $ucchotor->number_of_attempt = 0;
        $ucchotor->gain_marks = 0;
        $ucchotor->success_rate = 0;
        if ($request->hasFile('ucchotorimage')) {
            Storage::delete('public/question/pop_quiz_cq' . $ucchotor->image);
            $ucchotor->image = $request->ucchotorimage->store('public/question/pop_quiz_cq');
        }

        $saveucchotor = $ucchotor->save();

        $deleteContentTags = QuestionContentTag::where('exam_type', $exam->exam_type.' CQ')
            ->where('question_id', $ucchotor->id)
            ->get();

        foreach ($deleteContentTags as $deleteContentTag) {
            $delete = $deleteContentTag->delete();
        }

        if ($saveucchotor) {
            if (!empty($request->ucchotorcontentTagIds)) {
                for ($i = 0; $i < sizeOf($request->ucchotorcontentTagIds); $i++) {
                    $question_content_tag4 = new QuestionContentTag();
                    $question_content_tag4->exam_type = $exam->exam_type.' CQ';
                    $question_content_tag4->question_id = $ucchotor->id;
                    $question_content_tag4->content_tag_id = $request->ucchotorcontentTagIds[$i];
                    $question_content_tag4->save();
                }
            }
        }
        session()->flash('status', 'Pop Quiz CQ updateds successfully!');
        return redirect()->route('exam.show', $request->slug);
    }

    public function destroy(Exam $exam, $pop_quiz_cq_slug)
    {
        // $cq = PopQuizCreativeQuestion::where('slug', $pop_quiz_cq_slug)->firstOrFail();

        // $question_content_tags = QuestionContentTag::where("exam_type", $exam->exam_type.' CQ')->where('question_id', $cq->id)->get();

        // foreach($question_content_tags as $question_content_tag){
        //     $question_content_tag->delete();
        // }

        // $deleteCreativeQuestion = $cq->delete();

        // if ($deleteCreativeQuestion) {
        //     return redirect()->route('exam.show', $exam)->with('status', 'Pop Quiz CQ deleted successfully!');
        // } else {
        //     return redirect()->route('exam.show', $exam)->with('failed', 'Pop Quiz CQ deletion failed!');
        // }
        
        $creative_question = PopQuizCreativeQuestion::where('slug', $pop_quiz_cq_slug)->firstOrFail();

        $cqs = PopQuizCQ::where('creative_question_id', $creative_question->id)->get();

        foreach($cqs as $cq){
            $question_content_tags = QuestionContentTag::where("exam_type", $exam->exam_type.' CQ')->where('question_id', $cq->id)->get();
            
            foreach($question_content_tags as $question_content_tag){
                $question_content_tag->delete();
            }

            $cq->delete();
        }

        $deleteCreativeQuestion = $creative_question->delete();

        if ($deleteCreativeQuestion) {
            return redirect()->route('exam.show', $exam)->with('status', 'Topic End Exam CQ deleted successfully!');
        } else {
            return redirect()->route('exam.show', $exam)->with('failed', 'Topic End Exam CQ deletion failed!');
        }
    }
}
