<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Payment;
// use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::join('courses', 'payments.course_id', 'courses.id')
            ->join('users', 'payments.student_id', 'users.id')
            ->select('payments.*', 'users.name', 'courses.title')
            ->orderBy('payments.created_at', 'DESC')
            ->get();
        return view("admin.pages.payment.index", compact('payments'));
    }

    public function create()
    {
        return view("admin.pages.payment.create");
    }

    public function edit(Payment $payment)
    {
        return view("admin.pages.payment.edit", compact('payment'));
    }

    public function destroy(Payment $payment)
    {
        $delete = $payment->delete();
        if ($delete) {
            return redirect()->route('payment.index')->with('status', 'Payment successfully deleted!');
        } else {
            return redirect()->route('payment.index')->with('failed', 'Payment deletion failed!');
        }
    }
}
