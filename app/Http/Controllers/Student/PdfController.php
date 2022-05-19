<?php

namespace App\Http\Controllers\Student;

use PDF;
use App\Models\Admin\Course;
// use Illuminate\Http\Request;
use App\Models\Admin\Payment;
use App\Http\Controllers\Controller;

class PdfController extends Controller
{
    public function getInvoice(Course $course, Payment $payments)
    {
        // return view('student.pages.course.invoice-pdf', compact(['course', 'payments']));
        $pdf = PDF::loadView('student.pages.course.invoice-pdf', compact(['course', 'payments']));
        // dd($pdf);
        return $pdf->download("$course->title.pdf");
    }
}
