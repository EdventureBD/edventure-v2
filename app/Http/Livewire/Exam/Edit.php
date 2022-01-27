<?php

namespace App\Http\Livewire\Exam;

use Livewire\Component;
use App\Models\Admin\Exam;
use Illuminate\Support\Str;
use App\Models\Admin\Course;
use App\Models\Admin\ExamType;
use App\Models\Admin\CourseTopic;
use App\Models\Admin\CourseCategory;

class Edit extends Component
{
    public $exam;

    public $title;
    public $courseId;
    public $topicId;
    public $lectureId;
    public $examType;
    public $marks;
    public $duration;
    public $quesLimit;
    public $special;

    public $course;
    public $topic;
    public $order;
    // public $examType;

    public $show;


    public $showQuestionLimit;

    public function updatedTitle()
    {
        $this->validate([
            'title' => 'required|string|max:200'
        ]);
    }

    public function updatedCourseId()
    {
        $this->validate([
            'courseId' => 'required'
        ]);
    }

    // public function updatedTopic()
    // {
    //     $this->validate([
    //         'topicId' => 'required'
    //     ]);
    // }

    public function updatedMarks()
    {
        $this->validate([
            'marks' => 'required'
        ]);
    }

    public function updatedDuration()
    {
        $this->validate([
            'duration' => 'required'
        ]);
    }

    public function updatedOrder()
    {
        $this->validate([
            'order' => 'required|numeric|integer|gt:-1'
        ]);
    }

    public function updatedExamType()
    {
        if (($this->examType) == 'Assignment') {
            $this->quesLimit = 0;
            $this->showQuestionLimit = false;
        } else {
            $this->showQuestionLimit = true;
            $this->validate([
                'examType' => 'required'
            ]);
        }
    }

    public function updatedQuesLimit()
    {
        $this->validate([
            'quesLimit' => 'required'
        ]);
    }

    protected $rules = [
        'title' => 'required|string|max:325',
        'courseId' => 'required',
        'topicId' => 'nullable',
        'examType' => 'required',
        'marks' => 'required',
        'duration' => 'required',
        'order' => 'required|numeric|integer|gt:-1',
        'quesLimit' => 'required'
    ];

    public function saveExam()
    {
        $data = $this->validate();
        $exam = Exam::find($this->exam->id);
        $exam->title = $data['title'];
        // $exam->slug = Str::slug($data['title']);
        $exam->slug = (string) Str::uuid();
        $exam->course_id = $data['courseId'];
        $exam->topic_id = $data['topicId'];
        $exam->exam_type = $data['examType'];
        $exam->marks = $data['marks'];
        $exam->duration = $data['duration'];
        $exam->order = $data['order'];
        $exam->question_limit = $data['quesLimit'];

        $save = $exam->save();

        if ($save) {
            session()->flash('status', 'Exam edited successfully!');
            return redirect()->route('exam.index');
        } else {
            session()->flash('failed', 'Batch edited failed!');
            return redirect()->route('exam.edit', $this->exam->slug);
        }
    }

    public function mount()
    {
        $this->title = $this->exam->title;
        $this->courseId = $this->exam->course_id;
        $this->topicId = $this->exam->topic_id;
        $this->examType = $this->exam->exam_type;
        $this->marks = $this->exam->marks;
        $this->duration = $this->exam->duration;
        $this->order = $this->exam->order;
        $this->quesLimit = $this->exam->question_limit;
        $this->special = $this->exam->special;

        if ($this->special) {
            $this->show = false;
        } else {
            $this->show = true;
        }

        // $this->examType = ExamType::where('id', $this->examType)->first();
        $this->course = Course::where('id', $this->courseId)->first();

        if (!($this->special)) {
            $this->topic = CourseTopic::where('id', $this->topicId)->first();
        }

        if ($this->examType == 'Assignment') {
            $this->showQuestionLimit = false;
        } else {
            $this->showQuestionLimit = true;
        }
    }

    public function render()
    {
        return view('livewire.exam.edit');
    }
}
