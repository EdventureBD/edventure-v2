<?php

namespace App\Http\Livewire\ContentTag;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Admin\CourseCategory;
use App\Models\Admin\IntermediaryLevel;
use App\Models\Admin\Course;
use App\Models\Admin\ContentTag;
use App\Models\Admin\CourseTopic;
// use App\Models\Admin\CourseLecture;


class Create extends Component
{
    use WithFileUploads;

    public $title;
    public $categories;
    public $categoryId;
    public $intermediaryLevels;
    public $intermediaryLevelId;
    public $courses;
    public $courseId;
    public $topics;
    public $topicId;
    public $solutionVideo;
    public $solutionPdf;
    // public $lectureId;

    public function updatedTitle()
    {
        $this->validate([
            'title' => 'required|string|max:325'
        ]);
    }

    public function updatedSolutionVideo()
    {
        $this->validate([
            'solutionVideo' => ['string', 'min:3'],
        ]);
    }

    public function updatedSolutionPdf()
    {
        $this->validate([
            'solutionPdf' => ['file', 'mimes:pdf', 'max:50000'],
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
            'courseId' => 'required'
        ]);

        $this->topics = CourseTopic::where('course_id', $this->courseId)->get();
    }

    public function updatedTopicId()
    {
        $this->validate([
            'topicId' => 'required'
        ]);

        // $this->lectures = CourseLecture::where('topic_id', $this->topicId)->get();
    }

    // public function updatedLectureId()
    // {
    //     $this->validate([
    //         'lectureId' => 'required'
    //     ]);
    // }

    protected $rules = [
        'title' => 'required|string|max:200',
        'courseId' => 'required',
        'topicId' => 'required',
        // 'lectureId' => 'required',
    ];

    public function saveBatchLecture()
    {
        $data = $this->validate();

        if(isset($this->solutionPdf)){
            dd('Has PDF');
        }

        dd($data);

        $content_tag = new ContentTag();
        $content_tag->title = $data['title'];
        $content_tag->slug  =(string) Str::uuid();
        $content_tag->course_id = $data['courseId'];
        $content_tag->topic_id = $data['topicId'];
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
        $this->intermediaryLevels = collect();
        $this->courses = collect();
        $this->topics = collect();
        // $this->lectures = collect();
    }

    public function render()
    {
        // if (!empty($this->categories)) {
        //     $this->courses = Course::where('course_category_id', $this->categoryId)->get();
        // }
        // if (!empty($this->courses)) {
        //     $this->topics = CourseTopic::where('course_id', $this->courseId)->get();
        // }
        // if (!empty($this->topics)) {
        //     $this->lectures = CourseLecture::where('topic_id', $this->topicId)->get();
        // }
        return view('livewire.content-tag.create');
    }
}
