<?php

namespace App\Http\Livewire\CourseLecture;

use App\Models\Admin\Course;
use Livewire\Component;
use App\Models\Admin\CourseLecture;
use App\Models\Admin\CourseCategory;
use App\Models\Admin\CourseTopic;

class Edit extends Component
{
    public $courseLecture;
    public $courses;
    public $topics;

    public $title;
    public $courseId;
    public $topicId;
    public $url;
    public $markdownText;

    public function updatedTitle()
    {
        $this->validate([
            'title' => ['required', 'string', 'max:50'],
        ]);
    }

    public function updatedUrl()
    {
        $this->validate([
            'url' => ['required', 'string', 'max:9'],
        ]);
    }

    public function updatedCourseId()
    {
        $this->validate([
            'courseId' => 'required',
        ]);
    }

    public function updatedTopicId()
    {
        $this->validate([
            'topicId' => 'required',
        ]);
    }

    protected $rules = [
        'title' => ['required', 'string', 'max:50', 'regex:[^[a-zA-Z][a-zA-Z0-9. ,$;]+$]'],
        'url' => ['required', 'string', 'max:9'],
        'courseId' => 'required',
        'topicId' => 'required',
        'markdownText' => 'nullable',
    ];

    public function updateCourseLecture()
    {
        $data = $this->validate();
        $lecture = CourseLecture::find($this->courseLecture->id);
        $lecture->title = $data['title'];
        $lecture->course_id = $data['courseId'];
        $lecture->topic_id = $data['topicId'];
        $lecture->markdown_text = $data['markdownText'];
        $lecture->url = $data['url'];
        $save = $lecture->save();

        if ($save) {
            session()->flash('status', 'Course successfully updated!');
            return redirect()->route('course-lecture.index');
        } else {
            session()->flash('failed', 'Course updated failed!');
            return redirect()->route('course-lecture.edit', $this->courseLecture->slug);
        }
    }

    public function mount()
    {
        $this->title = $this->courseLecture->title;
        $this->courseId = $this->courseLecture->course_id;
        $this->topicId = $this->courseLecture->topic_id;
        $this->url = $this->courseLecture->url;
        $this->markdownText = $this->courseLecture->markdown_text;

        $this->courses = Course::all();
        $this->topics = CourseTopic::all();
    }

    public function render()
    {
        return view('livewire.course-lecture.edit');
    }
}
