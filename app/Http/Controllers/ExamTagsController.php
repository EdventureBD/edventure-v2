<?php

namespace App\Http\Controllers;

use App\Models\ExamTag;
use App\Models\ExamTopic;
use Illuminate\Http\Request;

class ExamTagsController extends Controller
{
    public function index()
    {
        $exam_topics = ExamTopic::query()->get();
        $exam_tags = ExamTag::query()->with('examTopic')->paginate(5);
        return view('admin.pages.model_exam.exam_tag.index', compact('exam_topics','exam_tags'));
    }

    public function store(Request $request)
    {
        $inputs =  $request->validate([
            'name' => 'required',
            'exam_topic_id' => 'required'
        ]);

        if($this->checkDuplicateTagName($inputs['exam_topic_id'],$inputs['name'])) {

            return redirect()->back()->with(['failed' => 'This tags is already added to this topic']);
        }

        ExamTag::create($inputs);
        return redirect()->back()->with(['status' => 'Tags Created Successfully']);
    }

    public function update(Request $request, $id)
    {
        $inputs =  $request->validate([
            'name' => 'required',
            'exam_topic_id' => 'required'
        ]);

        if($this->checkDuplicateTagName($inputs['exam_topic_id'],$inputs['name'])) {

            return redirect()->back()->with(['failed' => 'This tags is already added to a topic']);
        }

        ExamTag::query()->where('id', $id)->update($inputs);

        return redirect()->back()->with(['status' => 'Tags Updated Successfully']);
    }

    public function destroy($id)
    {
        ExamTag::query()->find($id)->delete();
        return redirect()->back()->with(['status' => 'Tags Deleted Successfully']);
    }

    public function show($id)
    {
        $tag = ExamTag::query()->where('id', $id)->with('examTopic')->first();
        return response()->json($tag);
    }

    private function checkDuplicateTagName($topicId,$topicName)
    {
        return ExamTag::query()
            ->where('exam_topic_id',$topicId)
            ->where('name',$topicName)
            ->exists();
    }
}
