<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\QuestionContentTag;
// use Illuminate\Http\Request;

class QuestionContentTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questionContentTags = QuestionContentTag::all();
        return view('admin.pages.question_content_tag.index', compact('questionContentTags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.question_content_tag.create');
    }

    public function edit(QuestionContentTag $questionContentTag)
    {
        return view("admin.pages.question_content_tag.edit", compact('questionContentTag'));
    }


    public function destroy(QuestionContentTag $questionContentTag)
    {
        $delete = $questionContentTag->delete();
        if ($delete) {
            return redirect()->route('question-content-tag.index')->with('status', 'deleted successfully!');
        } else {
            return redirect()->route('question-content-tag.index')->with('failed', 'deletion failed!');
        }
    }
}
