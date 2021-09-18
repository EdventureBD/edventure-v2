<?php

namespace App\Http\Controllers;

use App\Models\Admin\Payment;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function index()
    {
        $enrollRequests = Payment::join('courses', 'courses.id', 'payments.course_id')
            ->select('courses.title as courseTitle', 'payments.*')
            ->where('payments.accepted', 0)->get();
        return view('admin.pages.request.index', compact('enrollRequests'));
    }
}
