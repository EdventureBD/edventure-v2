<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\CourseCategory;
use Illuminate\Http\Request;

// models
Use App\Models\Admin\IntermediaryLevel;

class IntermediaryLevelController extends Controller
{
    public function index(){
        $intermediary_levels = IntermediaryLevel::with(['courseCategory'])->get();
        return view('admin.pages.intermediary_level.index', compact('intermediary_levels'));
    }
    
    public function create(){
        $categories = CourseCategory::all();
        
        return view('admin.pages.intermediary_level.create', compact('categories'));
    }

    public function edit($slug){
        $intermediary_level_slug = $slug;
        $categories = CourseCategory::all();

        return view('admin.pages.intermediary_level.edit', compact('categories', 'intermediary_level_slug'));
    }

    public function destroy($intermediaryLevel){

        $intermediary_level = IntermediaryLevel::where('slug', $intermediaryLevel)->with(['course', 'bundles'])->firstOrFail();
        if(count($intermediary_level->course) > 0){
            return redirect()->route('intermediary_level.index')->with('failed', 'Program cannot be deleted. It has courses associated to it.');
        }

        if(count($intermediary_level->bundles) > 0){
            return redirect()->route('intermediary_level.index')->with('failed', 'Program cannot be deleted. It has bundles associated to it.');
        }

        $delete = $intermediaryLevel->delete();
        if ($delete) {
            return redirect()->back()->with('status', 'Program successfully deleted!');
        } else {
            return redirect()->back()->with('failed', 'Program deletion failed!');
        }
    }

    public function changeIntermediaryLevelStatus(Request $request){

        $intermediary_level = IntermediaryLevel::find($request->id);
        $intermediary_level->status = $request->status;
        $intermediary_level->save();

        return response()->json(['success' => 'Status change successfully.']);
    }
}
