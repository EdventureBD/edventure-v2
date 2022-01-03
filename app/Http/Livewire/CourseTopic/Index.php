<?php

namespace App\Http\Livewire\CourseTopic;

use Livewire\Component;
use App\Models\Admin\Course;
use App\Models\Admin\CourseCategory;
use App\Models\Admin\CourseTopic;
use App\Models\Admin\IntermediaryLevel;

class Index extends Component
{
    public $categories;
    public $categoryId;
    public $intermediaryLevels;
    public $intermediaryLevelId;
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

    public function updatedCategoryId()
    {
        $this->intermediaryLevels = IntermediaryLevel::where('course_category_id', $this->categoryId)->get();
    }

    public function updatedIntermediaryLevelId()
    {
        $this->courses = Course::where('intermediary_level_id', $this->intermediaryLevelId)->get();
    }

    public function updatedcourseId($id)
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
        $this->intermediaryLevels = collect();
        $this->courses = collect();
    }

    public function render()
    {
        // if(isset($this->categoryId)){
        //     $this->intermediaryLevels = IntermediaryLevel::where('course_category_id', $this->categoryId)->get();
        // }

        // if (!empty($this->categories)) {
        //     $this->courses = Course::where('intermediary_level_id', $this->intermediaryLevelId)->get();
        // }

        // dump($this->categoryId, $this->intermediaryLevelId, $this->intermediaryLevels);

        return view('livewire.course-topic.index');
    }
}
