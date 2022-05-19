<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Exam;
// use Illuminate\Http\Request;
use App\Models\Admin\Assignment;
use App\Http\Controllers\Controller;

class AssignmentController extends Controller
{
    public function index(Exam $exam)
    {
        $assignments = Assignment::join('exams', 'assignments.exam_id', 'exams.id')
            ->select('assignments.*', 'exams.title as examTitle')
            ->where('exam_id', $exam->id)
            ->orderby('id', 'DESC')->get();
        return view('admin.pages.assignment.index', compact('assignments', 'exam'));
    }

    public function show(Exam $exam,Assignment $assignment)
    {
        $exam = Exam::where('id', $assignment->exam_id)->first();
        return view('admin.pages.assignment.details', compact('assignment', 'exam'));
    }

    public function edit(Exam $exam,Assignment $assignment)
    {
        return view('admin.pages.assignment.edit', compact('assignment'));
    }

    public function destroy(Exam $exam,Assignment $assignment)
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
