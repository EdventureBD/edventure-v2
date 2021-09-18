<?php

namespace App\Http\Livewire\CourseLecture;

use Livewire\Component;
use App\Models\Admin\Course;
use App\Models\Admin\CourseCategory;
use App\Models\Admin\CourseLecture;
use App\Models\Admin\CourseTopic;

class Index extends Component
{
    public $categoryId;
    public $courseId;
    public $topicId;

    public $categories;
    public $courses;
    public $topics;

    public $lectures;

    // public function showAll()
    // {
    //     $this->lectures = CourseLecture::join('courses', 'course_lectures.course_id', '=', 'courses.id')
    //         ->join('course_topics', 'course_lectures.topic_id', '=', 'course_topics.id')
    //         ->select('course_lectures.*', 'courses.title as courseName', 'course_topics.title as topicName')
    //         ->orderBy('course_lectures.created_at', 'DESC')
    //         ->get();
    // }

    public function updatedCourseId()
    {
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
            ->get();
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
        if (!empty($this->courses)) {
            $this->topics = CourseTopic::where('course_id', $this->courseId)->get();
        }

        return view('livewire.course-lecture.index');
    }
}
