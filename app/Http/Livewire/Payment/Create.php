<?php

namespace App\Http\Livewire\Payment;

use App\Models\User;
use Livewire\Component;
use App\Models\Admin\Batch;
use App\Models\Admin\Course;
use App\Models\Admin\Payment;
use App\Models\Admin\CourseCategory;
use App\Models\Admin\BatchStudentEnrollment;

class Create extends Component
{
    public $batch;
    public $batchHas;
    public $batchSlug;
    public $student;

    public $studentId;
    public $courseId;
    public $batchId;
    public $trxId;
    public $paymentType;
    public $amount;
    public $accountNumber;
    public $days;
    public $free;

    public $students;
    public $categories;
    public $courses;
    public $batches;
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

    public function updatedFree()
    {
        if ($this->free) {
            $this->trxId = "FREE-by-ADMIN";
            $this->paymentType = "FREE-by-ADMIN";
            $this->amount = 0;
            $this->accountNumber = 0;
        } else {
            $this->trxId = "";
            $this->paymentType = "";
            $this->amount = "";
            $this->accountNumber = "";
        }
    }

    protected $rules = [
        'studentId' => 'required',
        'courseId' => 'required',
        'batchId' => 'required',
        'trxId' => 'required',
        'paymentType' => 'required',
        'amount' => 'required|integer',
        'accountNumber' => 'required|',
        'days' => 'required'
    ];

    public function savePayment()
    {
        $user = User::find($this->studentId);

        $data = $this->validate();
        $days = $data['days'];
        $payment = new Payment();
        $payment->student_id = $data['studentId'];
        $payment->course_id = $data['courseId'];
        $payment->name = $user['name'];
        $payment->email = $user['email'];
        $payment->contact = $user['phone'];
        $payment->trx_id = $data['trxId'];
        $payment->payment_type = $data['paymentType'];
        $payment->amount = $data['amount'];
        $payment->payment_account_number = $data['accountNumber'];
        $payment->days_for = $days;

        $save = $payment->save();

        $batchStudentEnrollment = BatchStudentEnrollment::where('student_id', $this->studentId)
            ->where('course_id', $this->courseId)
            ->where('batch_id', $this->batchId)
            ->first();

        $batchStudentEnrollment->accessed_days = $batchStudentEnrollment->accessed_days + $days;
        $batchStudentEnrollment->payment_id = $payment->id;
        $batchStudentEnrollment->save();

        if ($save) {
            session()->flash('status', 'Payment successfull!');
            if ($this->batchHas) {
                return redirect()->route('batch.show', $this->batchSlug);
            }
            return redirect()->route('payment.index');
        } else {
            session()->flash('failed', 'Payment failed!');
            return redirect()->route('payment.create');
        }
    }

    public function mount()
    {
        if ($this->batch) {
            $this->batchHas = true;
            $this->batches = Batch::where('id', $this->batch)->first();
            $this->courses = Course::where('id', $this->batches->course_id)->first();
            $this->categories = CourseCategory::where('id', $this->courses->course_category_id)->first();
            $this->students = BatchStudentEnrollment::where('student_id', $this->student)->first();
            $this->studentId = $this->student;
            $this->courseId = $this->courses->id;
            $this->batchId = $this->batches->id;
            $this->batchSlug = $this->batches->slug;
        } else {
            $this->batchHas = false;
            $this->categories = CourseCategory::all();
        }
    }

    public function render()
    {
        if ($this->batchHas == false) {
            if (!empty($this->categories)) {
                $this->courses = Course::where('course_category_id', $this->categoryId)->get();
            }
            if (!empty($this->courseId)) {
                $this->batches = Batch::where('course_id', $this->courseId)->get();
            }
            if (!empty($this->batchId)) {
                $this->students = BatchStudentEnrollment::where('course_id', $this->courseId)
                    ->where('batch_id', $this->batchId)
                    ->get();
            }
        }
        return view('livewire.payment.create');
    }
}
