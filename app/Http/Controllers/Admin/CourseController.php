<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\BatchLecture;
use App\Models\Admin\Course;
use App\Models\Admin\IntermediaryLevel;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::join('intermediary_levels', 'courses.intermediary_level_id', '=', 'intermediary_levels.id')
        ->select('courses.*', 'intermediary_levels.title as name')
        ->orderByRaw('courses.created_at DESC')
        ->with(['bundle' => function($query){
            return $query->select('id', 'bundle_name');
        }])
        ->get();

        return view('admin.pages.course.index', compact('courses'));
    }

    public function create()
    {
        $intermediary_levels = IntermediaryLevel::where('status', 1)->get();
        return view('admin.pages.course.create', compact('intermediary_levels'));
    }

    public function show(Course $course)
    {
        $batch_lectures = BatchLecture::where('course_id', $course->id)->with(['courseTopic.CourseLecture'])->get();

        return view('admin.pages.course.details', compact('course', 'batch_lectures'));
    }

    public function edit(Course $course)
    {
        return view('admin.pages.course.edit', compact('course'));
    }

    public function destroy($course)
    {
        $course = Course::where('slug', $course)->with(['CourseTopic', 'Batch', 'Exam'])->firstOrFail();

        if(count($course->CourseTopic) > 0){
            return redirect()->route('course.index')->with('failed', 'Course cannot be deleted. It has islands associated to it.');
        }

        if(count($course->Batch) > 0){
            return redirect()->route('course.index')->with('failed', 'Course cannot be deleted. It has batches associated to it.');
        }

        if(count($course->Exam) > 0){
            return redirect()->route('course.index')->with('failed', 'Course cannot be deleted. It has exams associated to it.');
        }

        $delete = $course->delete();
        if ($delete) {
            return redirect()->route('course.index')->with('status', 'Course successfully deleted!');
        } else {
            return redirect()->route('course.index')->with('failed', 'Course deletion failed!');
        }
    }

    public function changeCourseStatus(Request $request)
    {
        $obj = Course::find($request->id);
        $obj->status = $request->status;
        $obj->save();

        return response()->json(['success' => 'Status change successfully.']);
    }

    public function addCourseLecture(Course $course)
    {
        return view('admin.pages.course.add_course_lecture_from_course_details', compact('course'));
    }
}
