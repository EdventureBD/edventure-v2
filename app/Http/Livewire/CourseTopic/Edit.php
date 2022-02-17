<?php

namespace App\Http\Livewire\CourseTopic;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

use App\Models\Admin\CourseCategory;
use App\Models\Admin\IntermediaryLevel;
use App\Models\Admin\Course;
use App\Models\Admin\CourseTopic;

class Edit extends Component
{
    use WithFileUploads;

    public $all_course_categories;
    public $courseCategory;
    public $courseCategoryId;
    public $all_intermediary_levels;
    public $intermediaryLevel;
    public $intermediaryLevelId;
    public $all_courses;
    public $course;
    public $courseId;
    public $course_topic;
    public $title;
    public $islandImage;

    public $show = false;

    protected $rules = [
        'title' => ['required', 'string', 'max:325'],
        'courseId' => ['required']
    ];

    public function updatedTitle()
    {
        $this->validate([
            'title' => ['required', 'string', 'max:325'],
        ]);
    }

    public function updatedCourseCategoryId()
    {
        $this->all_intermediary_levels = IntermediaryLevel::where('course_category_id', $this->courseCategoryId)->get();
    }

    public function updatedIntermediaryLevelId()
    {
        $this->all_courses = Course::where('intermediary_level_id', $this->intermediaryLevelId)->get();
    }

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
        $this->course = Course::where('id', $this->course_topic->course_id)->firstOrFail();
        $this->courseId = $this->course->id;
        // $this->courseId = $this->course_topic->course_id;
        $this->intermediaryLevel = IntermediaryLevel::where('id', $this->course->intermediary_level_id)->firstOrFail();
        $this->intermediaryLevelId = $this->intermediaryLevel->id;
        $this->courseCategory = CourseCategory::where('id', $this->intermediaryLevel->course_category_id)->firstOrFail();
        $this->courseCategoryId = $this->courseCategory->id;

        // dd($this->title, $this->course, $this->courseId,  $this->intermediaryLevel, $this->intermediaryLevelId, $this->courseCategory, $this->courseCategoryId);

        $this->all_course_categories = CourseCategory::all();
    }

    public function render()
    {
        return view('livewire.course-topic.edit');
    }
}
