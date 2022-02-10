<?php

namespace App\Http\Livewire\Course;

use App\Models\Admin\CourseCategory;
use App\Models\Admin\CourseLecture;
use Livewire\Component;

class CourseDetails extends Component
{
    public $course_topic; //THIS ONE IS PROPS

    public $lectures;

    public function mount()
    {
        $this->lectures = CourseLecture::where('topic_id', $this->course_topic->id)
            ->where('course_id', $this->course_topic->course_id)
            ->first();
    }

    public function render()
    {
        // dd($this->course_topic);
        return view('livewire.course.course-details');
    }
}
