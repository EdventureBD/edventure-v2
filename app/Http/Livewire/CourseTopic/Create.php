<?php

namespace App\Http\Livewire\CourseTopic;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Admin\Course;
use App\Models\Admin\CourseTopic;
use App\Models\Admin\CourseCategory;
use Illuminate\Support\Facades\Redirect;

class Create extends Component
{
    public $categories;
    public $categoryId;
    public $courses;
    public $title;
    public $course_id;

    public $show = true;

    public function updated()
    {
        $this->validate([
            'title' => 'required|string|max:50|unique:course_topics,title',
        ]);
    }

    protected $rules = [
        'title' => 'required|string|max:200|unique:course_topics,title',
        'course_id' => ['required'],
        'categories' => ['required']
    ];

    public function saveCourseTopic()
    {
        $data = $this->validate();
        $course_topic = new CourseTopic;
        $course_topic->title = $data['title'];
        $course_topic->slug = (string) Str::uuid();
        $course_topic->course_id = $data['course_id'];
        $course_topic->order = 0;
        $course_topic->status = 1;
        $url = url()->previous();
        $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();

        $slug = Course::where('id', $this->course_id)
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
        if (!($this->courses)) {
            $this->categories = CourseCategory::all();
            $this->show = false;
        } else {
            $this->categories = CourseCategory::where('id', $this->courses->course_category_id)->first();
            $this->categoryId = $this->categories->id;
            $this->course_id = $this->courses->id;
        }
    }

    public function render()
    {
        if (!empty($this->categories)) {
            $this->courses = Course::where('course_category_id', $this->categoryId)->get();
        }
        return view('livewire.course-topic.create');
    }
}
