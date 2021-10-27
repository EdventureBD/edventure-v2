<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\MCQ;
use App\Models\Admin\Exam;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\ContentTag;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\QuestionContentTag;
use App\Http\Controllers\Admin\ExamController;

class MCQController extends Controller
{
    public function index(Exam $exam)
    {
        $mcqs = MCQ::join('exams', 'm_c_q_s.exam_id', 'exams.id')
            ->select('m_c_q_s.*', 'exams.title as examTitle')
            ->where('exam_id', $exam->id)
            ->orderby('id', 'DESC')->get();
        return view('admin.pages.mcq.index', compact('mcqs', 'exam'));
    }

    public function create()
    {
        // this function is written in exam controller named  addQuestion
        ExamController::addQuestion(); //ignore the error. If you want to see the code just press the Alt key and left mouse button
    }

    public function store(Request $request, Exam $exam)
    {
       
        $validaterequest = $request->validate([
            'question' => 'required|min:4|unique:m_c_q_s',
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

        $mcq = new MCQ();
        $mcq->question = $request['question'];
        $mcq->slug = (string) Str::uuid();
        if ($request->hasFile('image')) {
            $mcq->image = $request->image->store('public/question/mcq');
            $mcq->image=Storage::url( $mcq->image);
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

        $question_id = MCQ::latest()->first();

        if ($save) {
            for ($i = 0; $i < sizeOf($request->contentTagIds); $i++) {
                $question_content_tag = new QuestionContentTag();
                $question_content_tag->exam_type = 'MCQ';
                $question_content_tag->question_id = $question_id->id;
                $question_content_tag->content_tag_id = $request->contentTagIds[$i];
                $question_content_tag->save();
            }
            session()->flash('status', 'MCQ created successfully!');
            return redirect()->route('exam.show', $request->slug);
        } else {
            session()->flash('failed', 'MCQ creation failed!');
            return redirect()->route('addQuestion');
        }
    }

    public function show(Exam $exam, MCQ $mcq)
    {

        $exam = Exam::where('id', $mcq->exam_id)->first();
        return view('admin.pages.mcq.details', compact('mcq', 'exam'));
    }

    public function edit(Exam $exam, MCQ $mcq)
    {
        $tagId = [];
        // $exam = Exam::where('id', $mcq->exam_id)->first();
        $questionContentTags = QuestionContentTag::where('exam_type', "MCQ")
            ->where('question_id', $mcq->id)
            ->get();
        foreach ($questionContentTags as $qct) {
            array_push($tagId, $qct->content_tag_id);
        }
        $contentTags = ContentTag::where('course_id', $exam->course_id)
            ->where('topic_id', $exam->topic_id)
            ->whereNotIn('id', $tagId)
            ->get();
        return view('admin.pages.mcq.edit', compact('mcq', 'exam', 'contentTags', 'questionContentTags'));
    }

    public function update(Request $request, Exam $exam, MCQ $mcq)
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

        $mcq = MCQ::find($mcq->id);

        if ($request->hasFile('image')) {
            if ($mcq->image) {
                Storage::delete($mcq->image);
            }
            $mcq->image = $request->image->store('public/question/mcq');
            $mcq->image=Storage::url( $mcq->image);
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

        $deleteContentTags = QuestionContentTag::where('exam_type', "MCQ")
            ->where('question_id', $mcq->id)
            ->get();
        foreach ($deleteContentTags as $deleteContentTag) {
            $delete = $deleteContentTag->delete();
        }

        if ($save) {
            for ($i = 0; $i < sizeOf($request->contentTagIds); $i++) {
                $question_content_tag = new QuestionContentTag();
                $question_content_tag->exam_type = 'MCQ';
                $question_content_tag->question_id = $mcq->id;
                $question_content_tag->content_tag_id = $request->contentTagIds[$i];
                $question_content_tag->save();
            }
            session()->flash('status', 'MCQ edited successfully!');
            return redirect()->route('exam.show', $request->slug);
        } else {
            session()->flash('failed', 'MCQ edit failed!');
            return redirect()->route('mcq.create');
        }
    }

    public function destroy(Exam $exam, MCQ $mcq)
    {
        $exam = Exam::where('id', $mcq->exam_id)->first();
        $delete = $mcq->delete();
        if ($delete) {
            return redirect()->route('exam.show', $exam)->with('status', 'MCQ deleted successfully!');
        } else {
            return redirect()->route('exam.show', $exam)->with('failed', 'MCQ deletion failed!');
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
