<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ContentTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContentTagController extends Controller
{
    public function index()
    {
        $content_tags = ContentTag::join('courses', 'content_tags.course_id', 'courses.id')
            ->join('course_topics', 'content_tags.topic_id', 'course_topics.id')
            ->select('content_tags.*', 'courses.title as courseName', 'course_topics.title as topicName')
            ->orderBy('content_tags.created_at', 'DESC')
            ->get();

        return view('admin.pages.content_tag.index', compact('content_tags'));
        // return view('admin.pages.content_tag.index'); // FOR LIVEWIRE
    }

    public function create()
    {
        return view('admin.pages.content_tag.create');
    }

    public function edit(ContentTag $contentTag)
    {
        return view('admin.pages.content_tag.edit', compact('contentTag'));
    }

    public function destroy(ContentTag $contentTag)
    {
        $fileName = "public/content_tags/pdf/" . substr($contentTag->solution_pdf, 26);
        Storage::delete($fileName);
        $delete = $contentTag->delete();
        if ($delete) {
            return redirect()->route('content-tag.index')->with('status', 'Content Tag successfully deleted!');
        } else {
            return redirect()->route('content-tag.index')->with('failed', 'Content Tag deletion failed!');
        }
    }

    public function changeContentTagStatus(Request $request)
    {
        $obj = ContentTag::find($request->id);
        $obj->status = $request->status;
        $obj->save();

        return response()->json(['success' => 'Status change successfully.']);
    }
}
