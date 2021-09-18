<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Models\Admin\Payment;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function payments($id)
    {
        $payments = Payment::where('student_id', $id)->get();
        // dd($payments);
        return view('student.pages.payment.index', compact('payments'));
    }
}
