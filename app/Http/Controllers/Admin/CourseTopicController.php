<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\CourseTopic;
use App\Models\Admin\CourseCategory;
use Illuminate\Http\Request;

class CourseTopicController extends Controller
{
    public function index()
    {
        // $categories = CourseCategory::where('status', 1)->get();    
        // , compact('categories')
        return view('admin.pages.course_topic.index');
    }

    public function create()
    {
        return view('admin.pages.course_topic.create');
    }

    public function customCourseTopic($course_category, $course)
    {
        dd($course_category);
    }

    public function edit(CourseTopic $course_topic)
    {
        return view('admin.pages.course_topic.edit', compact('course_topic'));
    }

    public function destroy(CourseTopic $course_topic)
    {
        $delete = $course_topic->delete();
        if ($delete) {
            return redirect()->route('course-topic.index')->with('status', 'Course topic successfully deleted!');
        } else {
            return redirect()->route('course-topic.index')->with('failed', 'Course topic deletion failed!');
        }
    }

    public function changeCourseTopicStatus(Request $request)
    {
        $obj = CourseTopic::find($request->id);
        $obj->status = $request->status;
        $obj->save();

        return response()->json(['success' => 'Status change successfully.']);
    }
}
