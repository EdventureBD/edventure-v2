<?php

namespace App\Http\Controllers\Student;

use App\Models\Admin\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\BatchStudentEnrollment;

class ProgressController extends Controller
{
    public function course($id)
    {
        if (auth()->user()->id == $id) {
            $batchStudentEnrollment = BatchStudentEnrollment::where('student_id', auth()->user()->id)->get();
            // dd($batchStudentEnrollment);
            return view('student.pages.progress.enrolled-course', compact('batchStudentEnrollment'));
        } else {
            abort(401);
        }
    }

    public function tagAnlysis($id, Course $course)
    {
        return $this->commonFunction($id, $course, "overall");
    }

    public function mcqAnalysis($id, Course $course)
    {
        return $this->commonFunction($id, $course, "mcq");
    }

    public function cqAnalysis($id, Course $course)
    {
        return $this->commonFunction($id, $course, "cq");
    }

    private function commonFunction($id, $course, $type)
    {
        if (auth()->user()->id == $id) {
            return view('student.pages.progress.tag-analysis', compact('course', 'type'));
        } else {
            abort(401);
        }
    }
}
