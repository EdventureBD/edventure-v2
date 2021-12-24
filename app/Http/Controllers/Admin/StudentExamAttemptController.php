<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\StudentExamAttempt;
use Illuminate\Http\Request;

class StudentExamAttemptController extends Controller
{
    public function index()
    {
        $student_exam_attempts = StudentExamAttempt::join('users', 'student_exam_attempts.student_id', 'users.id')
            ->join('exams', 'student_exam_attempts.exam_id', 'exams.id')
            ->select('student_exam_attempts.*', 'exams.title as examTitle', 'users.name as userName')
            ->orderBy('examTitle')
            ->get();
        return view('admin.pages.student_exam_attempt.index', compact('student_exam_attempts'));
    }

    public function destroy(StudentExamAttempt $studentExamAttempt)
    {
        $delete = $studentExamAttempt->delete();
        if ($delete) {
            return redirect()->route('student-exam-attempt.index')->with('status', 'Student Exam Attempt successfully deleted!');
        } else {
            return redirect()->route('student-exam-attempt.index')->with('failed', 'Student Exam Attempt deletion failed!');
        }
    }
}
