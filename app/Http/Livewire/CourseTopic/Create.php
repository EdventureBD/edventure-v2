<?php

namespace App\Http\Livewire\CourseTopic;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

use App\Models\Admin\Course;
use App\Models\Admin\CourseTopic;
use App\Models\Admin\CourseCategory;
use App\Models\Admin\IntermediaryLevel;

class Create extends Component
{
    use WithFileUploads;

    public $categories;
    public $categoryId;
    public $intermediaryLevels;
    public $intermediaryLevelId;
    public $title;
    public $courseId;
    public $islandImage;

    public $show = false;

    protected $rules = [
        'title' => ['required', 'string', 'max:200', 'unique:course_topics,title'],
        'categoryId' => ['required'],
        'intermediaryLevelId' => ['required'],
        'courseId' => ['required'],
        'islandImage' => ['required', 'file', 'image', 'max:5000'],
    ];

    public function updatedTitle(){
        $this->validate([
            'title' => ['required', 'string', 'max:200', 'unique:course_topics,title'],
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

    public function updatedIslandImage()
    {
        $this->validate([
            'islandImage' => ['required', 'file', 'image', 'max:5000'],
        ]);
    }

    public function saveCourseTopic()
    {
        $data = $this->validate();
        $course_topic = new CourseTopic;
        $course_topic->title = $data['title'];
        $course_topic->slug = (string) Str::uuid();
        if (!empty($this->islandImage)) {
            $course_topic->island_image = Storage::url($this->islandImage->store('public/roadmap/island_images'));
        }
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
