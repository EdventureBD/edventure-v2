<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// models
use App\Models\Admin\Bundle;
use App\Models\Admin\IntermediaryLevel;

class BundleController extends Controller
{
    public function index(){
        $bundles = Bundle::with('intermediary_level')->get();
        // dd('bindles index', $bundles);
        return view('admin.pages.bundle.index', compact('bundles'));
    }

    public function create(){
        $intermediary_levels = IntermediaryLevel::all();
        return view('admin.pages.bundle.create', compact('intermediary_levels'));
    }

    public function edit($bundle_slug){
        $bundle = Bundle::where('slug', $bundle_slug)->firstOrFail();
        // dd('bindles edit', $bundle);
        return view('admin.pages.bundle.edit', compact('bundle'));
    }

    public function destroy($bundle_slug){

        $bundle = Bundle::where('slug', $bundle_slug)->with('courses')->firstOrFail();

        if(count($bundle->courses) > 0){
            return redirect()->route('course.index')->with('failed', 'Bundle cannot be deleted. It has courses associated to it.');
        }

        if(!empty($bundle->icon)) {
            $fileName = "public/bundle/icon/" . str_replace('/storage/bundle/icon/', '', $bundle->icon);
            Storage::delete($fileName);
        }

        if(!empty($this->tempBanner)) {
            $fileName = "public/bundle/banner/" . str_replace('/storage/bundle/banner/', '', $bundle->banner);
            Storage::delete($fileName);
        }

        $delete = $bundle->delete();

        if ($delete) {
            return redirect()->route('bundle.index')->with('status', 'Bundle successfully deleted!');
        } else {
            return redirect()->route('bundle.index')->with('failed', 'Bundle deletion failed!');
        }
    }

    public function changeBundleStatus(Request $request){

        if($request->ajax()){
            $bundle = Bundle::findOrFail($request->id);
            $bundle->status = $request->status;
            $bundle->save();

            return ['success' => true];
        }
    }
}
