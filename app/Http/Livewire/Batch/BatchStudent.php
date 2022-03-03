<?php

namespace App\Http\Livewire\Batch;

use Livewire\Component;
use App\Models\Admin\Batch;
use App\Models\Admin\Course;
use App\Models\Admin\BatchStudentEnrollment;

class BatchStudent extends Component
{
    public $courses;
    public $courseId;
    public $batches;
    public $batchId;
    public $students;

    public $batch;
    public $course;

    public function updatedCourseId()
    {
        $this->batches = Batch::where('status', 1)->where('course_id', $this->courseId)->get();
        $this->course = Course::find($this->courseId);
    }

    public function updatedBatchId()
    {
        $this->students = BatchStudentEnrollment::where('status', 1)
            ->where('course_id', $this->courseId)
            ->where('batch_id', $this->batchId)
            ->get();
        $this->batch = Batch::find($this->batchId);
    }

    public function mount()
    {
        $this->courses = Course::where('status', 1)->get();
    }

    public function render()
    {
        return view('livewire.batch.batch-student');
    }
}
