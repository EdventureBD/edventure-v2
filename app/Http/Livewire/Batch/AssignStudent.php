<?php

namespace App\Http\Livewire\Batch;

use App\Models\User;
use Livewire\Component;
use App\Models\Admin\Batch;
use App\Models\Admin\Course;
use App\Models\Admin\Payment;
use App\Notifications\NotifyStudentEnroll;
use App\Models\Admin\BatchStudentEnrollment;

class AssignStudent extends Component
{
    public $enrollRequest;

    public $studentId;
    public $courseId;
    public $paymentId;

    public $batches;

    public $batchId;
    public $courseTitle;
    public $studentName;
    public $notes;
    public $days_for;

    public $course;
    public $student;
    public $batchTitle;

    public $show = false;

    protected $rules = [
        'batchId' => 'required',
        'days_for' => 'required',
    ];

    public function enrollToBatch()
    {
        $beforeBatchDays = 0;
        $individualDays = 0;
        $student = BatchStudentEnrollment::where('student_id', $this->studentId)
            ->where('course_id', $this->courseId)
            ->get();
        if ($student) {
            foreach ($student as $student) {
                $beforeBatchDays += $student->accessed_days;
                $individualDays = $student->individual_batch_days;
            }
        }
        $data = $this->validate();
        // $batchStudentEnrollment = new BatchStudentEnrollment();
        // $batchStudentEnrollment->batch_id = $data['batchId'];
        // $batchStudentEnrollment->payment_id = $this->paymentId;
        // $batchStudentEnrollment->course_id = $this->courseId;
        // $batchStudentEnrollment->note_list = $this->notes;
        // $batchStudentEnrollment->student_id = $this->studentId;
        // $batchStudentEnrollment->individual_batch_days = $individualDays;
        // $batchStudentEnrollment->accessed_days = $beforeBatchDays + $this->days_for;
        // $batchStudentEnrollment->status = 1;
        // $save = $batchStudentEnrollment->save();

        $batchStudentEnrollment = BatchStudentEnrollment::updateOrCreate(
            [
                'student_id' => $this->studentId,
                'course_id' => $this->courseId
            ],
            [
                'batch_id' => $data['batchId'],
                'payment_id' => $this->paymentId,
                'course_id' => $this->courseId,
                'note_list' => $this->notes,
                'student_id' => $this->studentId,
                'individual_batch_days' => $individualDays,
                'accessed_days' => $beforeBatchDays + $this->days_for,
                'status' => 1,
            ]
        );

        $payment = Payment::where('id', $this->paymentId)->first();
        $payment->accepted = 1;
        $payment->save();

        if ($batchStudentEnrollment) {
            $this->student->notify(new NotifyStudentEnroll($this->courseTitle, $this->batchTitle));
            session()->flash('status', 'Student assigned successfully to batch ' . $this->batchTitle);
            return redirect()->route('request.index');
        }
    }

    public function updatedBatchId()
    {
        $this->batchTitle = Batch::where('id', $this->batchId)->first();
        $this->batchTitle = $this->batchTitle->title;
    }

    public function mount()
    {
        $student = BatchStudentEnrollment::where('student_id', $this->studentId)
            ->where('course_id', $this->courseId)
            ->first();
        if ($student) {
            $this->show = true;
            $this->batches = Batch::where('course_id', $this->courseId)->where('id', $student->batch_id)->first();
            $this->batchId = $this->batches->id;
        } else {
            $this->batches = Batch::where('course_id', $this->courseId)->get();
        }

        $this->course = Course::where('id', $this->courseId)->first();
        $this->courseTitle  = $this->course->title;

        $this->student = User::where('id', $this->studentId)->first();
        $this->studentName  = $this->student->name;
        $this->days_for  = $this->enrollRequest->days_for;
    }

    public function render()
    {
        return view('livewire.batch.assign-student');
    }
}
