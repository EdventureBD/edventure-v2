<?php

namespace App\Http\Controllers;

use App\Models\ExamCategory;
use App\Models\ExamTopic;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ExamTopicController extends Controller
{
    /**
     * Load exam topics index page to create new topics
     * @return Application|Factory|View
     */
    public function index()
    {
        $exam_topics = ExamTopic::query()->with('examCategory')->orderByDesc('created_at')->paginate(5);
        $exam_categories = ExamCategory::query()->get();
        return view('admin.pages.model_exam.exam_topic.index', compact('exam_topics','exam_categories'));
    }

    /**
     * Store topics data
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $inputs =  $request->validate([
            'name' => 'required',
            'exam_category_id' => 'required'
        ]);

        if($this->checkDuplicateTopicName($inputs['exam_category_id'],$inputs['name'])) {

            return redirect()->back()->with(['failed' => 'This topic is already added to this category']);
        }

        ExamTopic::create($inputs);
        return redirect()->back()->with(['status' => 'Topic Created Successfully']);
    }

    /**
     * Delete specific topic
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        if($this->hasTags($id)) {
            return redirect()->back()->with(['warning' => 'Can not delete Topic! This Topic has its associative tags']);
        }

        ExamTopic::query()->find($id)->delete();
        return redirect()->back()->with(['status' => 'Topic Deleted Successfully']);
    }

    /**
     * Check if the topic name is already assigned within a selected category
     * Topic name should not duplicate for same category
     * @param $categoryId
     * @param $topicName
     * @return bool
     */
    private function checkDuplicateTopicName($categoryId,$topicName)
    {
        return ExamTopic::query()
                ->where('exam_category_id',$categoryId)
                ->where('name',$topicName)
                ->exists();
    }

    /**
     * Get single exam topic
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $topic = ExamTopic::query()->where('id', $id)->with('examCategory')->first();
        return response()->json($topic);
    }

    /**
     * Update specific exam topic
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $inputs =  $request->validate([
            'name' => 'required',
            'exam_category_id' => 'required'
        ]);

        if($this->checkDuplicateTopicName($inputs['exam_category_id'],$inputs['name'])) {

            return redirect()->back()->with(['failed' => 'This topic is already added to a category']);
        }

        ExamTopic::query()->where('id', $id)->update($inputs);

        return redirect()->back()->with(['status' => 'Topic Updated Successfully']);
    }

    /**
     * Check if the topic has its associative tags
     * If topic has tags, it can not be deleted
     * @param $topicId
     * @return bool
     */
    private function hasTags($topicId)
    {
        return ExamTopic::query()->where('id',$topicId)->has('examTags')->exists();
    }
}
