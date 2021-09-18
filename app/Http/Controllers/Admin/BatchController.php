<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Batch;
use App\Models\Admin\BatchLecture;
use App\Models\Admin\BatchStudentEnrollment;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function index()
    {
        $batches = Batch::join('users', 'batches.teacher_id', 'users.id')
            ->join('courses', 'batches.course_id', 'courses.id')
            ->select('batches.*', 'courses.title as courseName', 'users.name as userName')
            ->orderBy('batches.created_at', 'DESC')
            ->get();
        return view('admin.pages.batch.index', compact('batches'));
    }

    public function create()
    {
        return view('admin.pages.batch.create');
    }

    public function show(Batch $batch)
    {
        $batch_lectures = BatchLecture::join('course_topics', 'batch_lectures.topic_id', 'course_topics.id')
            ->join('courses', 'batch_lectures.course_id', 'courses.id')
            ->select('batch_lectures.*', 'courses.title as courseTitle', 'course_topics.title as courseTopicsTitle')
            ->where('batch_id', $batch->id)->get();
        $students = BatchStudentEnrollment::where('batch_id', $batch->id)->get();
        return view('admin.pages.batch.details', compact('batch', 'batch_lectures', 'students'));
    }

    public function edit(Batch $batch)
    {
        return view('admin.pages.batch.edit', compact('batch'));
    }

    public function destroy(Batch $batch)
    {
        $delete = $batch->delete();
        if ($delete) {
            return redirect()->route('batch.index')->with('status', 'Course category successfully deleted!');
        } else {
            return redirect()->route('batch.index')->with('failed', 'Course category deletion failed!');
        }
    }

    public function changeBatchStatus(Request $request)
    {
        $obj = Batch::find($request->id);
        $obj->status = $request->status;
        $obj->save();

        return response()->json(['success' => 'Batch changed successfully.']);
    }

    public function changeStudentStatus(Request $request)
    {
        $obj = BatchStudentEnrollment::find($request->id);
        $obj->status = $request->status;
        $obj->save();

        return response()->json(['success' => 'Student status changed successfully.']);
    }
}
