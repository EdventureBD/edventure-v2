<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExamExport;
use App\Exports\SlugExport;
use App\Imports\UserImport;
use Illuminate\Http\Request;
use App\Exports\CourseExport;
use App\Exports\ContentTagExport;
use App\Imports\ContentTagImport;
use App\Exports\CourseLectureExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class CSVController extends Controller
{
    public function emptyContentTag()
    {
        return Storage::download('public/excels/empty_content_tag.xlsx', 'Content Tag.xlsx');
    }

    public function emptyMCQ()
    {
        return Storage::download('public/excels/empty_mcq.xlsx', 'Empty MCQ.xlsx');
    }

    public function emptyCQ()
    {
        return Storage::download('public/excels/empty_cq.xlsx', 'Empty CQ.xlsx');
    }

    public function emptyAssignment()
    {
        return Storage::download('public/excels/empty_assignment.xlsx', 'Empty Assignment.xlsx');
    }

    public function courseCSV()
    {
        return Excel::download(new CourseExport, 'courses.xlsx');
    }

    public function courseLecturesCSV()
    {
        return Excel::download(new CourseLectureExport, 'Course Lecture.xlsx');
    }

    public function contentTagExportCSV()
    {
        return Excel::download(new ContentTagExport, 'All content Tags.xlsx');
    }

    public function examExportCSV()
    {
        return Excel::download(new ExamExport, 'All Exams.xlsx');
    }

    public function contentTagImportCSV(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xsl,xlsx',
        ]);
        $excel = Excel::import(new ContentTagImport, $request->file('file'));
        if ($excel) {
            return back()->with('status', 'Successfully uploaded content tags');
        }
    }

    public function UserImportCSV(Request $request)
    {
        // $request->validate([
        //     'file' => 'required|mimes:csv,xsl,xlsx',
        // ]);
        $excel = Excel::import(new UserImport, $request->file('file'));
        if ($excel) {
            return back()->with('status', 'Successfully imported user');
        }
    }

    public function slugExport(Request $request)
    {
        $request->validate([
            'slug' => 'required|numeric',
        ]);
        $slug = $request->slug;
        return Excel::download(new SlugExport($slug), 'Slugs.xlsx');
    }
}
