<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\CourseTopic;
use Illuminate\Http\Request;

class CourseTopicController extends Controller
{
    public function index()
    {
        return view('admin.pages.course_topic.index');
    }

    public function create()
    {
        return view('admin.pages.course_topic.create');
    }

    // public function customCourseTopic($course_category, $course)
    // {
    //     dd($course_category);
    // }

    public function edit(CourseTopic $course_topic)
    {
        return view('admin.pages.course_topic.edit', compact('course_topic'));
    }

    public function destroy($course_topic)
    {
        $course_topic = CourseTopic::where('slug', $course_topic)->with(['exams'])->firstOrFail();

        if(count($course_topic->exams) > 0){
            return redirect()->route('course-topic.index')->with('failed', 'island cannot be deleted. It has exams associated to it.');
        }

        if(file_exists(public_path($course_topic->zero_star_island_image))){
            unlink(public_path($course_topic->zero_star_island_image));
        }
        if(file_exists(public_path($course_topic->one_star_island_image))){
            unlink(public_path($course_topic->one_star_island_image));
        }
        if(file_exists(public_path($course_topic->two_star_island_image))){
            unlink(public_path($course_topic->two_star_island_image));
        }
        if(file_exists(public_path($course_topic->three_star_island_image))){
            unlink(public_path($course_topic->three_star_island_image));
        }
        if(file_exists(public_path($course_topic->disabled_island_image))){
            unlink(public_path($course_topic->disabled_island_image));
        }

        $delete = $course_topic->delete();

        if ($delete) {
            return redirect()->route('course-topic.index')->with('status', 'Island Successfully Deleted!');
        } else {
            return redirect()->route('course-topic.index')->with('failed', 'Island Deletion Failed!');
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
