<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\BatchExam;
use Illuminate\Http\Request;

class BatchExamController extends Controller
{
    public function index()
    {
        $batch_exams = BatchExam::join('batches', 'batch_exams.batch_id', 'batches.id')
            ->join('exams', 'batch_exams.exam_id', 'exams.id')
            ->select('batch_exams.*', 'batches.title as batchTitle', 'batches.slug as batchSlug', 'exams.title as examTitle', 'exams.slug as examSlug')
            ->get();
        // dd($batch_exams);
        return view('admin.pages.batch_exam.index', compact('batch_exams'));
    }

    public function create()
    {
        return view('admin.pages.batch_exam.create');
    }

    public function destroy(BatchExam $batchExam)
    {
        $delete = $batchExam->delete();
        if ($delete) {
            return redirect()->route('batch-exam.index')->with('status', 'Batch exam successfully deleted!');
        } else {
            return redirect()->route('batch-exam.index')->with('failed', 'Batch exam deletion failed!');
        }
    }

    public function changeBatchExamStatus(Request $request)
    {
        $obj = BatchExam::find($request->id);
        $obj->status = $request->status;
        $obj->save();

        return response()->json(['success' => 'Status change successfully.']);
    }
}
