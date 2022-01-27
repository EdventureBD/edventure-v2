<?php

namespace App\Http\Livewire\Exam;

use Livewire\Component;
use App\Models\Admin\Exam;
use Illuminate\Support\Str;
use App\Models\Admin\Course;
use App\Models\Admin\CourseTopic;
use App\Models\Admin\CourseCategory;
use App\Models\Admin\IntermediaryLevel;

class Create extends Component
{
    public $title;
    public $lectureId;
    public $examType;
    public $marks;
    public $duration;
    public $quesLimit;
    public $special;
    
    public $categories;
    public $categoryId;
    public $intermediaryLevels;
    public $intermediaryLevelId;
    public $courses;
    public $courseId;
    public $topics;
    public $topicId;
    public $order;
    // public $examTypes;

    public $showAssignment = true;
    public $showSpecialExam = true;

    public $showQuestionLimit = true;

    public function updatedCategoryId()
    {
        $this->intermediaryLevels = IntermediaryLevel::where('course_category_id', $this->categoryId)->get();
    }

    public function updatedIntermediaryLevelId()
    {
        $this->courses = Course::where('intermediary_level_id', $this->intermediaryLevelId)->get();
    }

    public function updatedTitle()
    {
        $this->validate([
            'title' => 'required|string|max:200'
        ]);
    }

    public function updatedSpecial()
    {
        if ($this->special) {
            $this->showAssignment = false;
            // $this->topicId = null;
        } else {
            $this->showAssignment = true;
            // $this->validate([
            //     'topicId' => 'required'
            // ]);
        }
    }

    public function updatedCourseId()
    {
        $this->validate([
            'courseId' => 'required'
        ]);

        $this->topics = CourseTopic::where('course_id', $this->courseId)->get();
    }

    public function updatedTopicId()
    {
        if(!$this->special){
            $this->validate([
                'topicId' => 'required'
            ]);
        }
    }

    public function updatedMarks()
    {
        $this->validate([
            'marks' => 'required|numeric|integer|gt:0'
        ]);
    }

    public function updatedDuration()
    {
        $this->validate([
            'duration' => 'required|numeric|integer|gt:0'
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
            $this->showSpecialExam = false;
            $this->marks=10;
            $this->duration=1440;
        } elseif( ($this->examType) == 'MCQ' || ($this->examType) == 'Aptitude Test') {
            $this->quesLimit = '';
            $this->showQuestionLimit = true;
            $this->showSpecialExam = true;
            $this->marks=null;
            $this->validate([
                'examType' => 'required'
            ]);
            $this->duration=null;
        }
    }

    public function updatedQuesLimit()
    {
        if (!empty ($this->examType) && ( ($this->examType) == 'MCQ' || ($this->examType) == 'Aptitude Test' )) {
            $this->marks=$this->quesLimit;
            $this->duration=$this->quesLimit;
        } else if (!empty ($this->examType) && ($this->examType) == 'CQ') {
            $this->marks=$this->quesLimit*10;
            $this->duration=$this->quesLimit*30;
        }
        $this->validate([
            'quesLimit' => 'required'
        ]);
    }

    protected $rules = [
        'title' => 'required|string|max:325|unique:exams',
        'courseId' => 'required',
        'topicId' => 'nullable',
        'examType' => 'required',
        'marks' => 'required|numeric|integer|gt:0',
        'duration' => 'required|numeric|integer|gt:0',
        'order' => 'required|numeric|integer|gt:-1',
        'quesLimit' => 'required|numeric|integer|gt:0',
        'special' => 'nullable|',
        'topicId' => 'nullable',
    ];

    protected $messages = [
        'title.unique' => 'The exam name already exists. Choose a different name',
    ];

    public function saveExam()
    {
        if(!$this->special){
            $this->rules['topicId'] = 'required';
        }
        $data = $this->validate();

        $exam = new Exam;
        $exam->title = $data['title'];
        // $exam->slug = Str::slug($data['title']);
        $exam->slug = (string) Str::uuid();
        $exam->course_id = $data['courseId'];
        $exam->topic_id = $data['topicId'];
        $exam->exam_type = $data['examType'];
        $exam->special = $data['special'];
        $exam->marks = $data['marks'];
        $exam->duration = $data['duration'];
        $exam->order = $data['order'];
        $exam->question_limit = $data['quesLimit'];

        $save = $exam->save();

        if ($save) {
            session()->flash('status', 'Exam created successfully!');
            return redirect()->route('exam.index');
        } else {
            session()->flash('failed', 'Exam created failed!');
            return redirect()->route('exam.create');
        }
    }

    public function mount()
    {
        $this->categories = CourseCategory::orderBy('title')->get();
        $this->intermediaryLevels = collect();
        $this->courses = collect();
        $this->topics = collect();
        // $this->examTypes = ExamType::orderBy('title')->get();
    }

    public function render()
    {
        // if (!empty($this->categories)) {
        //     $this->courses = Course::where('course_category_id', $this->categoryId)->get();
        // }
        // if (!empty($this->courses)) {
        //     $this->topics = CourseTopic::where('course_id', $this->courseId)->get();
        // }

        return view('livewire.exam.create');
    }
}
