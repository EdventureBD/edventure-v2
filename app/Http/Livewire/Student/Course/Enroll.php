<?php

namespace App\Http\Livewire\Student\Course;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Admin\Payment;
use Illuminate\Support\Facades\Auth;
use App\Notifications\EnrollCourseConfirm;

class Enroll extends Component
{
    public $course;
    public $studentDetails;

    public $month;
    public $amount;
    public $name;
    public $email;
    public $contact;
    public $method;
    public $transectionNumber;
    public $transectionID;

    public $saved = false;

    public function updatedMonth()
    {
        $this->validate([
            'month' => 'numeric|gt:0|lt:12'
        ]);
        $this->amount = (int)($this->amount);
        if ((is_numeric($this->amount))) {
            $this->amount = (($this->course->price) * (int)($this->month));
            $this->amount = $this->amount . ' taka';
        }
    }

    public function updatedContact()
    {
        $this->validate([
            'contact' => ['numeric', 'regex:/01[1|5|6|7|8|9][0-9]{8}/', 'digits:11']
        ]);
    }

    public function updatedTransectionNumber()
    {
        $this->validate([
            'transectionNumber' => ['numeric', 'regex:/01[1|5|6|7|8|9][0-9]{8}/', 'digits:11']
        ]);
    }

    protected $rules = [
        'month' => 'required|numeric|gt:0|lt:12',
        'amount' => 'required',
        'name' => 'required',
        'email' => 'required',
        'contact' => 'required',
        'method' => 'required',
        'transectionNumber' => ['required', 'numeric', 'regex:/01[1|5|6|7|8|9][0-9]{8}/i'],
        'transectionID' => 'required'
    ];

    public function confirmEnroll()
    {
        $data = $this->validate();
        $amount = Str::before($this->amount, ' taka');
        $payments = new Payment();
        $payments->student_id = auth()->user()->id;
        $payments->course_id = $this->course->id;
        $payments->name = $data['name'];
        $payments->email = $data['transectionID'];
        $payments->contact = $data['contact'];
        $payments->trx_id = $data['transectionID'];
        $payments->payment_type = $data['method'];
        $payments->amount = $amount;
        $payments->payment_account_number = $data['transectionNumber'];
        $payments->days_for = 30 * $data['month'];
        $save = $payments->save();
        $admin = User::where('is_admin', 1)->where('user_type', 1)->get();
        if ($save) {
            foreach ($admin as $admin) {
                $admin->notify(new EnrollCourseConfirm($data, $this->course));
            }
            session()->flash('status', 'Your Enrolment request sent successfully. Admin will contact with you within 3 days.');
            // return redirect()->route('invoice', ['course' => $this->course, 'payments' => $payments]);
            return redirect()->route('course-preview', ['course' => $this->course]);
        }
    }

    public function mount()
    {
        $zero = 0;
        $this->name =  Auth::user()->name;
        $this->email =  Auth::user()->email;
        if ($this->studentDetails) {
            $this->contact =  $zero . $this->studentDetails->contact;
        }
    }

    public function render()
    {
        return view('livewire.student.course.enroll');
    }
}
