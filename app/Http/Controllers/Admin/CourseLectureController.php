<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Course;
use App\Models\Admin\CourseLecture;
use App\Models\Admin\CourseTopic;
use Illuminate\Http\Request;

class CourseLectureController extends Controller
{
    public function index()
    {
        // $lectures = CourseLecture::join('courses', 'course_lectures.course_id', '=', 'courses.id')
        //     ->join('course_topics', 'course_lectures.topic_id', '=', 'course_topics.id')
        //     ->select('course_lectures.*', 'courses.title as courseName', 'course_topics.title as topicName')
        //     ->orderBy('course_lectures.created_at', 'DESC')
        //     ->get();
        // return view('admin.pages.course_lectures.index', compact('lectures'));
        return view('admin.pages.course_lectures.index');
    }

    public function create()
    {
        return view('admin.pages.course_lectures.create');
    }

    public function show(CourseLecture $courseLecture)
    {

        $course = Course::where('id', $courseLecture->course_id)->select('title')->first();
        $topic = CourseTopic::where('id', $courseLecture->topic_id)->select('title')->first();
        return view('admin.pages.course_lectures.view', compact('courseLecture', 'course', 'topic'));
    }

    public function edit(CourseLecture $courseLecture)
    {
        return view('admin.pages.course_lectures.edit', compact('courseLecture'));
    }

    public function destroy(CourseLecture $courseLecture)
    {
        $delete = $courseLecture->delete();
        if ($delete) {
            return redirect()->route('course-lecture.index')->with('status', 'Course lecture successfully deleted!');
        } else {
            return redirect()->route('course.index')->with('failed', 'Course lecture deletion failed!');
        }
    }

    public function changeCourseLectureStatus(Request $request)
    {
        $obj = CourseLecture::find($request->id);
        $obj->status = $request->status;
        $obj->save();

        return response()->json(['success' => 'Status change successfully.']);
    }
}
