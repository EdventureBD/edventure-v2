<?php

namespace App\Http\Livewire\CourseLecture;

use Livewire\Component;
use App\Models\Admin\Course;
use Livewire\WithFileUploads;
use App\Models\Admin\CourseTopic;
use App\Models\Admin\CourseLecture;
use App\Models\Admin\CourseCategory;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public $courseLecture;
    public $courses;
    public $topics;

    public $title;
    public $courseId;
    public $topicId;
    public $url;
    public $markdownText;
    public $pdf;
    public $prevpdf;

    public function updatedTitle()
    {
        $this->validate([
            'title' => ['required', 'string', 'max:50'],
        ]);
    }

    public function updatedUrl()
    {
        $this->validate([
            'url' => ['required', 'string'],
        ]);
    }

    public function updatedCourseId()
    {
        $this->validate([
            'courseId' => 'required',
        ]);
    }

    public function updatedPdf()
    {
        $this->validate([
            'pdf' => 'mimes:pdf|max:10000',
        ]);
    }


    public function updatedTopicId()
    {
        $this->validate([
            'topicId' => 'required',
        ]);
    }

    protected $rules = [
        'title' => ['required', 'string', 'max:50'],
        'url' => ['required', 'string'],
        'courseId' => 'required',
        'topicId' => 'required',
        'markdownText' => 'nullable',
        'pdf' => 'nullable|mimes:pdf|max:10000',
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
        if (!empty($this->pdf)) {
            $fileName = "public/lectures/pdf/".substr($this->prevpdf, 22);
            $delete = Storage::delete($fileName);
            $lecture->pdf = Storage::url($this->pdf->store('public/lectures/pdf'));
            $this->pdf=$lecture->pdf;

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
        $this->url = $this->courseLecture->url;
        $this->markdownText = $this->courseLecture->markdown_text;
        $this->pdf = $this->courseLecture->pdf;
        $this->prevpdf = $this->courseLecture->pdf;

        $this->courses = Course::all();
        $this->topics = CourseTopic::all();
    }

    public function render()
    {
        return view('livewire.course-lecture.edit');
    }
}
