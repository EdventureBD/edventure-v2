<?php

namespace App\Http\Livewire\CourseTopic;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Admin\Course;
use App\Models\Admin\CourseTopic;
use App\Models\Admin\CourseCategory;
use App\Models\Admin\IntermediaryLevel;

class Create extends Component
{
    public $categories;
    public $categoryId;
    public $intermediaryLevels;
    public $intermediaryLevelId;
    public $courses;
    public $title;
    public $courseId;

    public $show = false;

    protected $rules = [
        'title' => 'required|string|max:200|unique:course_topics,title',
        'categoryId' => ['required'],
        'intermediaryLevelId' => ['required'],
        'courseId' => ['required']
    ];

    public function updatedCategoryId()
    {
        $this->intermediaryLevels = IntermediaryLevel::where('course_category_id', $this->categoryId)->get();
    }

    public function updatedIntermediaryLevelId()
    {
        $this->courses = Course::where('intermediary_level_id', $this->intermediaryLevelId)->get();
    }

    public function saveCourseTopic()
    {
        $data = $this->validate();

        $course_topic = new CourseTopic;
        $course_topic->title = $data['title'];
        $course_topic->slug = Str::slug($data['title']);
        $course_topic->intermediary_level_id = $data['intermediaryLevelId'];
        $course_topic->course_id = $data['courseId'];
        $course_topic->order = 0;
        $course_topic->status = 1;
        $url = url()->previous();
        $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();

        $slug = Course::where('id', $this->courseId)
            ->select('courses.slug')
            ->first();

        $save = $course_topic->save();

        if ($save) {
            session()->flash('status', 'Course topic created successfully!');
            if ($route == "course.show") {
                return redirect()->route('course.show', $slug);
            } else {
                return redirect()->route('course-topic.index');
            }
        } else {
            session()->flash('failed', 'Course topic created failed!');
            return redirect()->route('course-topic.create');
        }
    }

    public function mount()
    {
        $this->categories = CourseCategory::all();
        $this->intermediaryLevels = collect();
        $this->courses = collect();
    }

    public function render()
    {
        return view('livewire.course-topic.create');
    }
}
