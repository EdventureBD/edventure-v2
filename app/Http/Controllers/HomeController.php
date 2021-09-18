<?php

namespace App\Http\Controllers;

use App\Models\Admin\Course;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function StudentIndex()
    {
        $courses = Course::where('status', 1)->orderBy('order')->take(5)->get();
        $courseCount = Course::where('status', 1)->count();
        dd($courseCount);
        return view('student.pages.frontend.student', compact('courses', 'courseCount'));
    }
}
