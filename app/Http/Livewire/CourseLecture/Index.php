<?php

namespace App\Http\Livewire\CourseLecture;

use Livewire\Component;
use App\Models\Admin\Course;
use App\Models\Admin\CourseCategory;
use App\Models\Admin\CourseLecture;
use App\Models\Admin\CourseTopic;
use App\Models\Admin\IntermediaryLevel;

class Index extends Component
{
    public $categories;
    public $categoryId;
    public $intermediaryLevels;
    public $intermediaryLevelId;
    public $courses;
    public $courseId;
    public $topics;
    public $topicId;
    public $lectures;

    // public function showAll()
    // {
    //     $this->lectures = CourseLecture::join('courses', 'course_lectures.course_id', '=', 'courses.id')
    //         ->join('course_topics', 'course_lectures.topic_id', '=', 'course_topics.id')
    //         ->select('course_lectures.*', 'courses.title as courseName', 'course_topics.title as topicName')
    //         ->orderBy('course_lectures.created_at', 'DESC')
    //         ->get();
    // }

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
        $this->topics = CourseTopic::where('course_id', $this->courseId)->get();
        $this->lectures = CourseLecture::join('courses', 'course_lectures.course_id', '=', 'courses.id')
            ->join('course_topics', 'course_lectures.topic_id', '=', 'course_topics.id')
            ->select('course_lectures.*', 'courses.title as courseName', 'course_topics.title as topicName')
            ->where('courses.id', $this->courseId)
            ->orderBy('course_lectures.created_at', 'DESC')
            ->get();
    }

    public function updatedTopicId()
    {
        $this->lectures = CourseLecture::join('courses', 'course_lectures.course_id', '=', 'courses.id')
            ->join('course_topics', 'course_lectures.topic_id', '=', 'course_topics.id')
            ->select('course_lectures.*', 'courses.title as courseName', 'course_topics.title as topicName')
            ->where('courses.id', $this->courseId)
            ->where('course_topics.id', $this->topicId)
            ->orderBy('course_lectures.created_at', 'DESC')
            ->with('exam')
            ->get();
    }

    public function mount()
    {
        $this->categories = CourseCategory::all();
        $this->intermediaryLevels = collect();
        $this->courses = collect();
        $this->topics = collect();
    }

    public function render()
    {
        return view('livewire.course-lecture.index');
    }
}
