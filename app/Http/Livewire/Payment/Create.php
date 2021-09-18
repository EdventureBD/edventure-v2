<?php

namespace App\Http\Livewire\Payment;

use App\Models\User;
use Livewire\Component;
use App\Models\Admin\Course;
use App\Models\Admin\CourseCategory;
use App\Models\Admin\Payment;

class Create extends Component
{
    public $studentId;
    public $courseId;
    public $trxId;
    public $paymentType;
    public $amount;
    public $accountNumber;
    public $days;

    public $students;
    public $categories;
    public $courses;
    public $categoryId;

    public function updatedStudentId()
    {
        $this->validate([
            'studentId' => 'required'
        ]);
    }

    public function updatedCourseId()
    {
        $this->validate([
            'courseId' => 'required'
        ]);
    }

    public function updatedTrxId()
    {
        $this->validate([
            'trxId' => 'required'
        ]);
    }

    public function updatedPaymentType()
    {
        $this->validate([
            'paymentType' => 'required'
        ]);
    }

    public function updatedAmount()
    {
        $this->validate([
            'amount' => 'required|integer'
        ]);
    }

    public function updatedAccountNumber()
    {
        $this->validate([
            'accountNumber' => 'required|'
        ]);
    }

    public function updatedDays()
    {
        $this->validate([
            'days' => 'required'
        ]);
    }

    protected $rules = [
        'studentId' => 'required',
        'courseId' => 'required',
        'trxId' => 'required',
        'paymentType' => 'required',
        'amount' => 'required|integer',
        'accountNumber' => 'required|',
        'days' => 'required'
    ];

    public function savePayment()
    {
        $data = $this->validate();
        $days = 30 * $data['days'];
        dd($days);
        $payment = new Payment();
        $payment->student_id = $data['studentId'];
        $payment->course_id = $data['courseId'];
        $payment->trx_id = $data['trxId'];
        $payment->payment_type = $data['paymentType'];
        $payment->amount = $data['amount'];
        $payment->payment_account_number = $data['accountNumber'];
        $payment->days_for = $days;

        $save = $payment->save();

        if ($save) {
            session()->flash('status', 'Payment successfull!');
            return redirect()->route('payment.index');
        } else {
            session()->flash('failed', 'Payment failed!');
            return redirect()->route('payment.create');
        }
    }

    public function mount()
    {
        $this->students = User::where('user_type', 3)->where('is_admin', 0)->get();
        $this->categories = CourseCategory::all();
    }

    public function render()
    {
        if (!empty($this->categories)) {
            $this->courses = Course::where('course_category_id', $this->categoryId)->get();
        }
        return view('livewire.payment.create');
    }
}
