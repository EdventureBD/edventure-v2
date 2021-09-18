<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Exam;
use Illuminate\Http\Request;
use App\Models\Admin\Assignment;
use App\Http\Controllers\Controller;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::join('exams', 'assignments.exam_id', 'exams.id')
            ->select('assignments.*', 'exams.title as examTitle')
            ->get();
        return view('admin.pages.assignments.index', compact('assignments'));
    }

    public function show(Assignment $assignment)
    {
        $exam = Exam::where('id', $assignment->exam_id)->first();
        return view('admin.pages.assignment.details', compact('assignment', 'exam'));
    }

    public function edit(Assignment $assignment)
    {
        return view('admin.pages.assignment.edit', compact('assignment'));
    }

    public function destroy(Assignment $assignment)
    {
        $exam = Exam::where('id', $assignment->exam_id)->first();
        $delete = $assignment->delete();
        if ($delete) {
            return redirect()->route('exam.show', $exam)->with('status', 'Assignment deleted successfully!');
        } else {
            return redirect()->route('exam.show', $exam)->with('failed', 'Assignment deletion failed!');
        }
    }
}
