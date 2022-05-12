<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\BatchLecture;
use Illuminate\Http\Request;

class BatchLectureController extends Controller
{
    public function index()
    {
        $batchlectures = BatchLecture::join('batches', 'batch_lectures.batch_id', 'batches.id')
            ->join('courses', 'batch_lectures.course_id', 'courses.id')
            ->join('course_topics', 'batch_lectures.topic_id', 'course_topics.id')
            ->select('batch_lectures.*', 'courses.title as courseName', 'batches.title as batchName', 'course_topics.title as courseTopicName')
            ->get();
        return view('admin.pages.batch_lectures.index', compact('batchlectures'));
    }

    public function create()
    {
        return view('admin.pages.batch_lectures.create');
    }

    public function store(Request $request)
    {
        // dd($request);
        $validateData = $request->validate([
            'batchId' => 'required',
            'courseId' => 'required',
            'topicId' => 'required',
        ]);
        $batchLecture = new BatchLecture();
        $batchLecture->batch_id = $request->batchId;
        $batchLecture->course_id = $request->courseId;
        $batchLecture->topic_id = $request->topicId;
        $batchLecture->status = 1;
        $save = $batchLecture->save();
        if ($save) {
            session()->flash('status', 'Batch Successfully Added to Island!');
            return back();
        } else {
            session()->flash('failed', 'Failed to Add Batch to Island !');
            return back();
        }
    }

    public function destroy(BatchLecture $batchLecture)
    {
        $delete = $batchLecture->delete();
        if ($delete) {
            return back()->with('status', 'Batch Successfully Removed from Island !');
        } else {
            return back()->with('failed', 'Failed to Remove Batch from Island!');
        }
    }

    public function changeBatchLectureStatus(Request $request)
    {
        $obj = BatchLecture::find($request->id);
        $obj->status = $request->status;
        $obj->save();

        return response()->json(['success' => 'Status change successfully.']);
    }
}
