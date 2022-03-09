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
    public $oneStarIslandImage;
    public $twoStarIslandImage;
    public $threeStarIslandImage;
    public $disabledIslandImage;

    public $show = false;

    protected $rules = [
        'courseCategoryId' => ['required'],
        'intermediaryLevelId' => ['required'],
        'courseId' => ['required'],
        'oneStarIslandImage' => ['required', 'file', 'image', 'max:5000'],
        'twoStarIslandImage' => ['required', 'file', 'image', 'max:5000'],
        'threeStarIslandImage' => ['required', 'file', 'image', 'max:5000'],
        'disabledIslandImage' => ['required', 'file', 'image', 'max:5000'],
    ];

    public function updatedTitle(){
        $this->validate([
            'title' => ['required', 'string', 'max:200', 'unique:course_topics,title,'.$this->course_topic->id],
        ]);
    }

    public function updatedCourseCategoryId()
    {
        $this->all_intermediary_levels = IntermediaryLevel::where('course_category_id', $this->courseCategoryId)->get();
        $this->all_courses = collect();
    }

    public function updatedIntermediaryLevelId()
    {
        $this->all_courses = Course::where('intermediary_level_id', $this->intermediaryLevelId)->get();
    }

    public function updatedOneStarIslandImage()
    {
        $this->validate([
            'oneStarIslandImage' => ['required', 'file', 'image', 'max:5000'],
        ]);
    }

    public function updatedTwoStarIslandImage()
    {
        $this->validate([
            'twoStarIslandImage' => ['required', 'file', 'image', 'max:5000'],
        ]);
    }

    public function updatedThreeStarIslandImage()
    {
        $this->validate([
            'threeStarIslandImage' => ['required', 'file', 'image', 'max:5000'],
        ]);
    }

    public function updatedDisabledIslandImage()
    {
        $this->validate([
            'disabledIslandImage' => ['required', 'file', 'image', 'max:5000'],
        ]);
    }

    public function updateCourseTopic()
    {
        $this->rules['title'] = ['required', 'string', 'max:200', 'unique:course_topics,title,'.$this->course_topic->id];
        $data = $this->validate();
        $course_topic = CourseTopic::find($this->course_topic->id);
        $course_topic->title = $data['title'];
        if (!empty($this->oneStarIslandImage)) {
            unlink(public_path($course_topic->one_star_island_image));
            $course_topic->one_star_island_image = Storage::url($this->oneStarIslandImage->store('public/roadmap/island_images'));
        }
        if (!empty($this->twoStarIslandImage)) {
            unlink(public_path($course_topic->two_star_island_image));
            $course_topic->two_star_island_image = Storage::url($this->twoStarIslandImage->store('public/roadmap/island_images'));
        }
        if (!empty($this->threeStarIslandImage)) {
            unlink(public_path($course_topic->three_star_island_image));
            $course_topic->three_star_island_image = Storage::url($this->threeStarIslandImage->store('public/roadmap/island_images'));
        }
        if (!empty($this->disabledIslandImage)) {
            unlink(public_path($course_topic->disabled_island_image));
            $course_topic->disabled_island_image = Storage::url($this->disabledIslandImage->store('public/roadmap/island_images'));
        }
        $course_topic->course_id = $data['courseId'];
        $course_topic->intermediary_level_id = $data['intermediaryLevelId'];
        $course_topic->slug = (string) Str::uuid();
        $course_topic->order = 0;
        $course_topic->status = 1;
        $save = $course_topic->save();

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
        $this->all_course_categories = CourseCategory::all();

        $this->courseId = $this->course_topic->course_id;
        $this->course = Course::where('id', $this->courseId)->firstOrFail();
        $this->intermediaryLevelId = $this->course_topic->intermediary_level_id;
        $this->intermediaryLevel = IntermediaryLevel::where('id', $this->intermediaryLevelId)->firstOrFail();
        $this->courseCategoryId = $this->intermediaryLevel->course_category_id;
        $this->courseCategory = CourseCategory::where('id', $this->courseCategoryId)->firstOrFail();
        $this->all_intermediary_levels = IntermediaryLevel::where('course_category_id', $this->courseCategoryId)->get();
        $this->all_courses = Course::where('intermediary_level_id', $this->intermediaryLevelId)->get();
    }

    public function render()
    {
        return view('livewire.course-topic.edit');
    }
}
