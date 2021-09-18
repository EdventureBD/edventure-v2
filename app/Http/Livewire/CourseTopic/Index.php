<?php

namespace App\Http\Livewire\CourseTopic;

use Livewire\Component;
use App\Models\Admin\Course;
use App\Models\Admin\CourseCategory;
use App\Models\Admin\CourseTopic;

class Index extends Component
{
    public $categories;
    public $categoryId;
    public $courses;
    public $title;
    public $topics;
    public $courseId;
    public $show = false;

    // public function showAll()
    // {
    //     $this->topics = CourseTopic::join('courses', 'course_topics.course_id', '=', 'courses.id')
    //         ->select('course_topics.*', 'courses.title as name')
    //         ->orderBy('courses.created_at', 'DESC')
    //         ->get();
    //     $this->categoryId = '';
    //     $this->courseId = '';
    // }

    public function updatedcourseId()
    {
        if (!empty($this->courses)) {
            $this->topics = CourseTopic::join('courses', 'course_topics.course_id', '=', 'courses.id')
                ->select('course_topics.*', 'courses.title as name')
                ->orderBy('courses.title')
                ->where('courses.id', $this->courseId)
                ->get();
        }
        $this->show = true;
    }

    public function mount()
    {
        $this->categories = CourseCategory::all();
    }

    public function render()
    {
        if (!empty($this->categories)) {
            $this->courses = Course::where('course_category_id', $this->categoryId)->get();
        }

        return view('livewire.course-topic.index');
    }
}
