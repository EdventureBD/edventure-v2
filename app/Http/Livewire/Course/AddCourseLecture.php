<?php

namespace App\Http\Livewire\Course;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Admin\CourseTopic;
use App\Models\Admin\CourseLecture;
use App\Models\Admin\CourseCategory;
use App\Models\Admin\Exam;
use Illuminate\Support\Facades\Storage;

class AddCourseLecture extends Component
{
    use WithFileUploads;

    public $categories;
    public $categoryId;
    public $intermediaryLevels;
    public $intermediaryLevelId;
    public $course;
    public $courseId;
    public $course_topics;
    public $topicId;
    public $title;
    public $url;
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

        $this->slug = Str::slug($this->title);

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

    public function updatedTopicId()
    {
        $this->validate([
            'topicId' => 'required',
        ]);

        $this->exams = Exam::where('course_id', $this->course->id)->where('topic_id', $this->topicId)->where(function($query) {
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
        'url' => ['required', 'string', 'min:3'],
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
        $lecture->course_id = $this->course->id;
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
            return redirect()->route('course.show', [$this->course->slug]);
        } else {
            session()->flash('failed', 'Course lecture added failed!');
            return redirect()->route('course.show', [$this->course->slug]);
        }
    }

    public function mount()
    {
        $this->categories = CourseCategory::all();
        $this->intermediaryLevels = collect();
        $this->courseId = $this->course->id;
        $this->course_topics = CourseTopic::where('course_id', $this->course->id)->get();
        $this->exams = collect();
    }

    public function render()
    {
        return view('livewire.course.add-course-lecture');
    }
}
