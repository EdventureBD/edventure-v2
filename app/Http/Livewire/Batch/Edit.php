<?php

namespace App\Http\Livewire\Batch;

use App\Models\Admin\Batch;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Admin\Course;

class Edit extends Component
{
    public $batch;
    public $title;
    public $student_limit;
    public $batch_running_days;
    public $teacher_id;
    public $course_id;
    public $teachers;
    public $courses;

    public function updatedTitle()
    {
        $this->validate([
            'title' => ['required', 'string', 'max:325'],
        ]);
    }

    public function updatedStudent_limit()
    {
        $this->validate([
            'student_limit' => ['required', 'numeric'],
        ]);
    }

    public function updatedBatch_running_days()
    {
        $this->validate([
            'batch_running_days' => ['required', 'numeric'],
        ]);
    }

    public function updatedTeacher_id()
    {
        $this->validate([
            'teacher_id' => ['required'],
        ]);
    }

    public function updatedCourse_id()
    {
        $this->validate([
            'course_id' => ['required'],
        ]);
    }

    protected $rules = [
        'title' => ['required', 'string', 'max:325'],
        'student_limit' => ['required', 'numeric'],
        'batch_running_days' => ['required', 'numeric'],
        'teacher_id' => ['required'],
        'course_id' => ['required'],
    ];

    public function updateBatch()
    {
        $data = $this->validate();
        $batch = Batch::find($this->batch->id);
        $batch->title = $data['title'];
        $batch->slug = Str::slug($data['title']);
        $batch->batch_running_days = $data['batch_running_days'];
        $batch->teacher_id = $data['teacher_id'];
        $batch->student_limit = $data['student_limit'];
        $batch->course_id = $data['course_id'];
        $save = $batch->save();

        if ($save) {
            session()->flash('status', 'Batch successfully updated!');
            return redirect()->route('batch.index');
        } else {
            session()->flash('failed', 'Batch added failed!');
            return redirect()->route('batch.edit', $this->batch->slug);
        }
    }

    public function mount()
    {
        $this->title = $this->batch->title;
        $this->student_limit = $this->batch->student_limit;
        $this->batch_running_days = $this->batch->batch_running_days;
        $this->teacher_id = $this->batch->teacher_id;
        $this->course_id = $this->batch->course_id;

        $this->courses = Course::all()->map->only('id', 'title');
        $this->teachers = User::where('is_Admin', '=', 0)
            ->where('user_type', '=', 2)->get()->map->only('id', 'name');
    }

    public function render()
    {
        return view('livewire.batch.edit');
    }
}
