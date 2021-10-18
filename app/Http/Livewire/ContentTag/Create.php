<?php

namespace App\Http\Livewire\ContentTag;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Admin\Course;
use App\Models\Admin\ContentTag;
use App\Models\Admin\CourseTopic;
use App\Models\Admin\CourseLecture;
use App\Models\Admin\CourseCategory;

class Create extends Component
{
    public $title;
    public $categoryId;
    public $courseId;
    public $topicId;
    public $lectureId;

    public $categories;
    public $courses;
    public $topics;
    public $lectures;

    public function updatedTitle()
    {
        $this->validate([
            'title' => 'required|string|max:50'
        ]);
    }

    public function updatedCourseId()
    {
        $this->validate([
            'courseId' => 'required'
        ]);
    }

    public function updatedTopicId()
    {
        $this->validate([
            'topicId' => 'required'
        ]);
    }

    public function updatedLectureId()
    {
        $this->validate([
            'lectureId' => 'required'
        ]);
    }

    protected $rules = [
        'title' => 'required|string|max:50',
        'courseId' => 'required',
        'topicId' => 'required',
        'lectureId' => 'required',
    ];

    public function saveBatchLecture()
    {
        $data = $this->validate();
        $content_tag = new ContentTag();
        $content_tag->title = $data['title'];
        $content_tag->slug  =(string) Str::uuid();
        $content_tag->course_id = $data['courseId'];
        $content_tag->topic_id = $data['topicId'];
        $content_tag->lecture_id = $data['lectureId'];
        $content_tag->status = 1;

        $save = $content_tag->save();

        if ($save) {
            session()->flash('status', 'Content Tag successfully added!');
            return redirect()->route('content-tag.index');
        } else {
            session()->flash('failed', 'Content Tag added failed!');
            return redirect()->route('content-tag.create');
        }
    }

    public function mount()
    {
        $this->categories = CourseCategory::orderBy('title')->get();
    }

    public function render()
    {
        if (!empty($this->categories)) {
            $this->courses = Course::where('course_category_id', $this->categoryId)->get();
        }
        if (!empty($this->courses)) {
            $this->topics = CourseTopic::where('course_id', $this->courseId)->get();
        }
        if (!empty($this->topics)) {
            $this->lectures = CourseLecture::where('topic_id', $this->topicId)->get();
        }
        return view('livewire.content-tag.create');
    }
}
