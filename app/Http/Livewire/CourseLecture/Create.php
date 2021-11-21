<?php

namespace App\Http\Livewire\CourseLecture;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Admin\Course;
use Livewire\WithFileUploads;
use App\Models\Admin\CourseTopic;
use App\Models\Admin\CourseLecture;
use App\Models\Admin\CourseCategory;
use Illuminate\Support\Facades\Storage;

class Create extends Component
{
    use WithFileUploads;

    public $course_topics;
    public $courses;
    public $title;
    public $courseId;
    public $topicId;
    public $url;
    public $markdownText;
    public $pdf;

    public $categories;
    public $categoryId;

    public function updatedTitle()
    {
        $this->validate([
            'title' => ['required', 'string', 'max:50'],
        ]);
    }

    public function updatedUrl()
    {
        $this->validate([
            'url' => ['required', 'string', 'min:3'],
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

    public function updatedPdf()
    {
        $this->validate([
            'pdf' => 'mimes:pdf|max:10000',
        ]);
    }

    protected $rules = [
        'title' => ['required', 'string', 'max:50'],
        'url' => ['required', 'string', 'min:3'],
        'courseId' => 'required',
        'topicId' => 'required',
        'markdownText' => 'nullable',
        'pdf' => 'nullable|mimes:pdf|max:10000',
    ];

    public function saveCourseLecture()
    {
        $data = $this->validate();
        $lecture = new CourseLecture;
        $lecture->title = $data['title'];
        $lecture->course_id = $data['courseId'];
        $lecture->topic_id = $data['topicId'];
        $lecture->markdown_text = $data['markdownText'];
        $lecture->url = $data['url'];
        $lecture->slug = Str::slug($data['title']);
        $lecture->status = 1;
        $lecture->order = 0;
        if (!empty($this->pdf)) {
            $lecture->pdf = Storage::url($this->pdf->store('public/lectures/pdf'));
        }

        $save = $lecture->save();

        if ($save) {
            session()->flash('status', 'Course lecture successfully added!');
            return redirect()->route('course-lecture.index');
        } else {
            session()->flash('failed', 'Course lecture added failed!');
            return redirect()->route('course-lecture.create');
        }
    }

    public function mount()
    {
        $this->categories = CourseCategory::all();
    }

    public function render()
    {
        if (!empty($this->categories)) {
            $this->courses = Course::where('course_category_id', $this->categoryId)->get();
        }
        if (!empty($this->courses)) {
            $this->course_topics = CourseTopic::where('course_id', $this->courseId)->get();
        }
        return view('livewire.course-lecture.create');
    }
}
