<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\LiveClass;
use Illuminate\Http\Request;

class LiveClassController extends Controller
{
    public function index()
    {
        $liveclasses = LiveClass::all();
        return view('admin.pages.live_class.index', compact('liveclasses'));
    }

    public function create()
    {
        return view('admin.pages.live_class.create');
    }


    public function edit(LiveClass $liveClass)
    {
        // dd($liveClass);
        return view('admin.pages.live_class.edit', compact('liveClass'));
    }

    public function destroy(LiveClass $liveClass)
    {
        $delete = $liveClass->delete();
        if ($delete) {
            return redirect()->route('live-class.index')->with('status', 'Live Class successfully deleted!');
        } else {
            return redirect()->route('live-class.index')->with('failed', 'Live Class deletion failed!');
        }
    }

    public function changeLiveClassStatus(Request $request)
    {
        $obj = LiveClass::find($request->id);
        $obj->status = $request->status;
        $obj->save();

        return response()->json(['success' => 'Status change successfully.']);
    }
}
