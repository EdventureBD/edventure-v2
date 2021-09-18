<?php

namespace App\Http\Livewire\CourseTopic;

use Livewire\Component;
use App\Models\Admin\Course;
use App\Models\Admin\CourseCategory;
use App\Models\Admin\CourseTopic;

class Edit extends Component
{
    public $course_topic;
    public $courses;

    public $title;
    public $courseId;

    public function updatedTitle()
    {
        $this->validate([
            'title' => ['required', 'string', 'max:50', 'regex:[^[a-zA-Z][a-zA-Z0-9. ,$;]+$]'],
        ]);
    }

    public function updatedCategoryId()
    {
        if (!empty($this->categories)) {
            $this->courses = Course::where('course_category_id', $this->categoryId)->get();
        }
    }

    protected $rules = [
        'title' => ['required', 'string', 'max:50', 'regex:[^[a-zA-Z][a-zA-Z0-9. ,$;]+$]'],
        'courseId' => ['required']
    ];

    public function updateCourseTopic()
    {
        $data = $this->validate();
        $topic = CourseTopic::find($this->course_topic->id);
        $topic->title = $data['title'];
        $topic->course_id = $data['courseId'];
        $save = $topic->save();

        if ($save) {
            session()->flash('status', 'Course successfully updated!');
            return redirect()->route('course-topic.index');
        } else {
            session()->flash('failed', 'Course updated failed!');
            return redirect()->route('course-topic.edit', $this->course_topic->slug);
        }
    }

    public function mount()
    {
        $this->title = $this->course_topic->title;
        $this->courseId = $this->course_topic->course_id;

        $this->courses = Course::all();
    }

    public function render()
    {
        return view('livewire.course-topic.edit');
    }
}
