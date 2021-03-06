<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

 //models
 use App\Models\Admin\AptitudeTestMCQ;
 use App\Models\Admin\QuestionContentTag;
 use App\Models\Admin\Exam;
 use App\Models\Admin\ContentTag;

class AptitudeTestMCQController extends Controller
{
    public function index(Exam $exam)
    {
        
        $aptitude_test_mcqs = AptitudeTestMCQ::join('exams', 'aptitude_test_mcqs.exam_id', 'exams.id')
        ->select('aptitude_test_mcqs.*', 'exams.title as examTitle')
        ->where('exam_id', $exam->id)
        ->orderby('id', 'DESC')->get();

        return view('admin.pages.aptitude_test.index', compact('aptitude_test_mcqs', 'exam'));
    }

    public function store(Request $request, Exam $exam)
    {
        $validaterequest = $request->validate([
            'question' => 'required|min:4|unique:aptitude_test_mcqs',
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

        $aptitude_test_mcqs = new AptitudeTestMCQ();
        $aptitude_test_mcqs->question = $request['question'];
        $aptitude_test_mcqs->slug = (string) Str::uuid();
        if ($request->hasFile('image')) {
            $aptitude_test_mcqs->image = $request->image->store('public/question/aptitude_test_mcqs');
            $aptitude_test_mcqs->image = Storage::url($aptitude_test_mcqs->image);
        }
        $aptitude_test_mcqs->field1 = $request['field1'];
        $aptitude_test_mcqs->field2 = $request['field2'];
        $aptitude_test_mcqs->field3 = $request['field3'];
        $aptitude_test_mcqs->field4 = $request['field4'];
        $aptitude_test_mcqs->answer = $request['answer'];
        $aptitude_test_mcqs->exam_id = $request->examId;
        $aptitude_test_mcqs->explanation = $request['explanation'];
        $aptitude_test_mcqs->number_of_attempt = 0;
        $aptitude_test_mcqs->gain_marks = 0;
        $aptitude_test_mcqs->success_rate = 0;

        $save = $aptitude_test_mcqs->save();

        if ($save) {
            for ($i = 0; $i < sizeOf($request->contentTagIds); $i++) {
                $question_content_tag = new QuestionContentTag();
                $question_content_tag->exam_type = $exam->exam_type;
                $question_content_tag->question_id = $aptitude_test_mcqs->id;
                $question_content_tag->content_tag_id = $request->contentTagIds[$i];
                $question_content_tag->save();
            }
            session()->flash('status', 'Aptitude Test MCQ created successfully!');
            return redirect()->route('exam.show', $request->slug);
        } else {
            session()->flash('failed', 'Aptitude Test MCQ creation failed!');
            return redirect()->route('addQuestion');
        }
    }

    public function show(Exam $exam, AptitudeTestMCQ $aptitude_test_mcq)
    {
        $exam = Exam::where('id', $aptitude_test_mcq->exam_id)->first();
        return view('admin.pages.aptitude_test.details', compact('aptitude_test_mcq', 'exam'));
    }

    public function edit(Exam $exam, AptitudeTestMCQ $aptitude_test_mcq)
    {
        $tagId = [];
        $questionContentTags = QuestionContentTag::where('exam_type', $exam->exam_type)
            ->where('question_id', $aptitude_test_mcq->id)
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

        return view('admin.pages.aptitude_test.edit', compact('aptitude_test_mcq', 'exam', 'contentTags', 'questionContentTags'));
    }

    public function update(Request $request, Exam $exam, AptitudeTestMCQ $aptitude_test_mcq)
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
            if ($aptitude_test_mcq->image) {
                Storage::delete($aptitude_test_mcq->image);
            }
            $aptitude_test_mcq->image = $request->image->store('public/question/mcq');
            $aptitude_test_mcq->image = Storage::url($aptitude_test_mcq->image);
        }

        $aptitude_test_mcq->question = $request['question'];
        $aptitude_test_mcq->field1 = $request['field1'];
        $aptitude_test_mcq->field2 = $request['field2'];
        $aptitude_test_mcq->field3 = $request['field3'];
        $aptitude_test_mcq->field4 = $request['field4'];
        $aptitude_test_mcq->answer = $request['answer'];
        $aptitude_test_mcq->explanation = $request['explanation'];
        $aptitude_test_mcq->exam_id = $request['examId'];

        $save = $aptitude_test_mcq->save();

        $deleteContentTags = QuestionContentTag::where('exam_type', $exam->exam_type)
            ->where('question_id', $aptitude_test_mcq->id)
            ->get();
        foreach ($deleteContentTags as $deleteContentTag) {
            $delete = $deleteContentTag->delete();
        }

        if ($save) {
            for ($i = 0; $i < sizeOf($request->contentTagIds); $i++) {
                $question_content_tag = new QuestionContentTag();
                $question_content_tag->exam_type = $exam->exam_type;
                $question_content_tag->question_id = $aptitude_test_mcq->id;
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

    public function destroy(Exam $exam, AptitudeTestMCQ $aptitude_test_mcq)
    {
        $exam = Exam::where('id', $aptitude_test_mcq->exam_id)->first();

        $question_content_tags = QuestionContentTag::where("exam_type", $exam->exam_type)->where('question_id', $aptitude_test_mcq->id)->get();

        foreach($question_content_tags as $question_content_tag){
            $question_content_tag->delete();
        }

        $delete = $aptitude_test_mcq->delete();
        if ($delete) {
            return redirect()->route('exam.show', $exam)->with('status', 'Aptitude Test MCQ deleted successfully!');
        } else {
            return redirect()->route('exam.show', $exam)->with('failed', 'Aptitude Test MCQ deletion failed!');
        }
    }
}


// NO NEED BUT DON'T DELETE IT{
    // for ($i = 0; $i < sizeOf($request->contentTagIds); $i++) {
    //     DB::table('users')
    //         ->updateOrInsert(
    //             [
    //                 'content_tag_id' => $request->contentTagIds[$i],
    //                 'question_id' => $mcq->id
    //             ],
    //             [
    //                 'exam_type' => 'MCQ',
    //                 'question_id' => $mcq->id,
    //                 'content_tag_id' => '$request->contentTagIds[$i]',
    //             ]
    //         );
    // }
// }