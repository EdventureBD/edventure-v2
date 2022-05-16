<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\CourseCategory;
use App\Http\Controllers\Controller;
use App\Models\Admin\Course;
use App\Models\Admin\IntermediaryLevel;

class CourseCategoryController extends Controller
{
    public function index()
    {
        $categories = CourseCategory::orderBy('created_at', 'DESC')->get();
        $total = CourseCategory::count();
        return view('admin.pages.course_category.index', compact('categories', 'total'));
    }

    public function create()
    {
        return view('admin.pages.course_category.create');
    }

    public function show(CourseCategory $courseCategory)
    {
        $intermediary_levels = IntermediaryLevel::where('course_category_id', $courseCategory->id)->get();
        $total = $intermediary_levels->count();
        return view('admin.pages.course_category.details', compact('courseCategory', 'intermediary_levels', 'total'));
    }

    public function edit(CourseCategory $courseCategory)
    {
        return view('admin.pages.course_category.edit', compact('courseCategory'));
    }

    public function destroy($courseCategory)
    {
        $courseCategory = CourseCategory::where('slug', $courseCategory)->with(['intermediary_level'])->firstOrFail();
        if(count($courseCategory->intermediary_level) > 0){
            return redirect()->route('course-category.index')->with('failed', 'Course category cannot be deleted. It has programs associated to it.');
        }
        $delete = $courseCategory->delete();
        if ($delete) {
            return redirect()->route('course-category.index')->with('status', 'Course category successfully deleted!');
        } else {
            return redirect()->route('course-category.index')->with('failed', 'Course category deletion failed!');
        }
    }

    public function changeCourseCategoryStatus(Request $request)
    {
        $obj = CourseCategory::find($request->id);
        $obj->status = $request->status;
        $obj->save();

        return response()->json(['success' => 'Status change successfully.']);
    }
}
