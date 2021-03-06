<?php

namespace App\Http\Livewire\CourseLecture;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Admin\Course;
use Livewire\WithFileUploads;
use App\Models\Admin\CourseTopic;
use App\Models\Admin\CourseLecture;
use App\Models\Admin\CourseCategory;
use App\Models\Admin\IntermediaryLevel;
use App\Models\Admin\Exam;
use Illuminate\Support\Facades\Storage;

class Create extends Component
{
    use WithFileUploads;

    public $categories;
    public $categoryId;
    public $intermediaryLevels;
    public $intermediaryLevelId;
    public $courses;
    public $courseId;
    public $course_topics;
    public $topicId;
    public $title;
    public $url = '...';
    public $markdownText;
    public $pdf;

    public $exams;
    public $examId;

    public $slug;

    public function updatedTitle()
    {
        $this->validate([
            'title' => ['required', 'string', 'max:325', 'unique:course_lectures,title,'],
        ]);

        $this->slug = ['slug' => Str::slug($this->title)];

        $this->validate([
            'slug' => ['unique:course_lectures,slug'],
        ]);
    }

    public function updatedUrl()
    {
        $this->validate([
            'url' => ['required', 'string', 'min:3'],
        ]);
    }

    public function updatedCategoryId()
    {
        $this->intermediaryLevels = IntermediaryLevel::where('course_category_id', $this->categoryId)->get();
    }

    public function updatedIntermediaryLevelId()
    {
        $this->courses = Course::where('intermediary_level_id', $this->intermediaryLevelId)->get();
    }

    public function updatedCourseId()
    {
        $this->validate([
            'courseId' => 'required',
        ]);

        $this->course_topics = CourseTopic::where('course_id', $this->courseId)->get();
    }

    public function updatedTopicId()
    {
        $this->validate([
            'topicId' => 'required',
        ]);

        $this->exams = Exam::where('course_id', $this->courseId)->where('topic_id', $this->topicId)->where(function($query) {
            return $query->where('exam_type', 'Pop Quiz')->orWhere('exam_type', 'Topic End Exam');
        })->get();
    }

    public function updatedExamId()
    {
        $this->validate([
            'examId' => 'required',
        ]);
    }

    public function updatedPdf()
    {
        $this->validate([
            'pdf' => 'mimes:pdf|max:50000',
        ]);
    }

    protected $rules = [
        'title' => ['required', 'string', 'max:325', 'unique:course_lectures,title'],
        'slug' => ['unique:course_lectures,slug'],
        'url' => ['nullable', 'string', 'min:3'],
        'courseId' => 'required',
        'topicId' => 'required',
        'examId' => 'required',
        'markdownText' => 'nullable',
        'pdf' => 'nullable|mimes:pdf|max:50000',
    ];

    protected $messages = [
        'slug.unique' => 'Slug generated from this title is already in use. Try another title.',
    ];

    public function saveCourseLecture()
    {
        $this->slug = Str::slug($this->title);

        $data = $this->validate();
        $lecture = new CourseLecture;
        $lecture->title = $data['title'];
        $lecture->course_id = $data['courseId'];
        $lecture->topic_id = $data['topicId'];
        $lecture->exam_id = $data['examId'];
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
        $this->intermediaryLevels = collect();
        $this->courses = collect();
        $this->course_topics = collect();
        $this->exams = collect();
    }

    public function render()
    {
        return view('livewire.course-lecture.create');
    }
}
