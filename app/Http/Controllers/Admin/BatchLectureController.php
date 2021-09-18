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

    public function destroy(BatchLecture $batchLecture)
    {
        $delete = $batchLecture->delete();
        if ($delete) {
            return redirect()->route('batch-lecture.index')->with('status', 'Batch Lecture successfully deleted!');
        } else {
            return redirect()->route('batch-lecture.index')->with('failed', 'Batch Lecture deletion failed!');
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
