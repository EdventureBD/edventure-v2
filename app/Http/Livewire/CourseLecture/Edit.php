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

class Edit extends Component
{
    use WithFileUploads;

    public $courseLecture;
    public $courses;
    public $topics;
    public $exams;
    public $title;
    
    public $examId;
    public $courseId;
    public $topicId;
    public $url;
    public $markdownText;
    public $pdf;
    public $prevpdf;

    public function updatedTitle()
    {
        $this->validate([
            'title' => ['required', 'string', 'max:325'],
        ]);
    }

    public function updatedUrl()
    {
        $this->validate([
            'url' => ['required', 'string'],
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
            'pdf' => 'mimes:pdf|max:10000',
        ]);
    }

    protected $rules = [
        'title' => ['required', 'string', 'max:325'],
        'url' => ['required', 'string'],
        'courseId' => 'required',
        'topicId' => 'required',
        'examId' => 'required',
        'markdownText' => 'nullable',
        'pdf' => 'nullable|max:10000',
    ];

    public function updateCourseLecture()
    {
        $data = $this->validate();
        $lecture = CourseLecture::find($this->courseLecture->id);
        $lecture->title = $data['title'];
        $lecture->course_id = $data['courseId'];
        $lecture->topic_id = $data['topicId'];
        $lecture->exam_id = $data['examId'];
        $lecture->markdown_text = $data['markdownText'];
        $lecture->url = $data['url'];
        if (!empty($this->pdf)) {
            $fileName = "public/lectures/pdf/" . substr($this->prevpdf, 22);
            $delete = Storage::delete($fileName);
            $lecture->pdf = Storage::url($this->pdf->store('public/lectures/pdf'));
        }
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
        $this->examId = $this->courseLecture->exam_id;
        $this->url = $this->courseLecture->url;
        $this->markdownText = $this->courseLecture->markdown_text;
        // $this->pdf = $this->courseLecture->pdf;
        $this->prevpdf = $this->courseLecture->pdf;

        $this->courses = Course::all();
        $this->topics = CourseTopic::all();
        $this->exams = Exam::all();
    }

    public function render()
    {
        return view('livewire.course-lecture.edit');
    }
}
