<?php

namespace App\Http\Livewire\Exam;

use Livewire\Component;
use App\Models\Admin\Exam;
use Illuminate\Support\Str;
use App\Models\Admin\Course;
// use App\Models\Admin\ExamType;
use App\Models\Admin\CourseTopic;
use App\Models\Admin\CourseCategory;
use App\Models\Admin\IntermediaryLevel;
// use App\Models\Admin\CourseCategory;

class Edit extends Component
{
    public $exam;

    public $title;
    // public $lectureId;
    public $examType;
    public $marks;
    public $duration;
    public $quesLimit;
    public $quesLimit_2;
    public $special;

    public $category;
    public $categoryId;
    public $intermediaryLevel;
    public $intermediaryLevelId;
    public $course;
    public $courseId;
    public $topic;
    public $topicId;
    public $order;
    public $threshold_marks;
    // public $examType;
    public $show;

    public $showQuestionLimit = true;

    public $showQuestionLimit2 = false;

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

    public function updatedThreshold_marks()
    {
        $this->validate([
            'threshold_marks' => 'required|numeric|integer|gt:-1'
        ]);
    }

    public function updatedExamType()
    {
        // if (($this->examType) == 'Assignment') {
        //     $this->quesLimit = 0;
        //     $this->showQuestionLimit = false;
        // } else {
        //     $this->showQuestionLimit = true;
        //     $this->validate([
        //         'examType' => 'required'
        //     ]);
        // }

        if (($this->examType) == 'Assignment') {
            $this->quesLimit = 0;
            $this->showQuestionLimit = false;
            $this->showQuestionLimit2 = false;
            // $this->showSpecialExam = false;
            $this->marks=10;
            $this->duration=1440;
        } elseif( ($this->examType) == 'MCQ' || ($this->examType) == 'Aptitude Test') {
            $this->quesLimit = '';
            $this->showQuestionLimit = true;
            $this->showQuestionLimit2 = false;
            // $this->showSpecialExam = true;
            $this->marks=null;
            $this->validate([
                'examType' => 'required'
            ]);
            $this->duration=null;
        } elseif ( ($this->examType) == 'Pop Quiz' || ($this->examType) == 'Topic End Exam' ){
            $this->showQuestionLimit2 = true;
        } elseif( ($this->examType) == 'CQ' ){
            $this->showQuestionLimit2 = false;
        }
    }

    public function updatedQuesLimit()
    {
        if (!empty ($this->examType) && ( ($this->examType) == 'MCQ' || ($this->examType) == 'Aptitude Test' )) {
            $this->marks = $this->quesLimit;
            $this->duration = $this->quesLimit;
        } else if (!empty ($this->examType) && ($this->examType) == 'CQ') {
            $this->marks = $this->quesLimit*10;
            $this->duration = $this->quesLimit*30;
        }
        $this->validate([
            'quesLimit' => 'required'
        ]);
    }

    protected $rules = [
        // 'title' => 'required|string|max:325|unique:exams,title,'.$this->exam->id,
        'courseId' => 'required',
        'topicId' => 'nullable',
        'examType' => 'required',
        'marks' => 'required|numeric|integer|gt:0',
        'duration' => 'required|numeric|integer|gt:0',
        'order' => 'required|numeric|integer|gt:-1',
        'threshold_marks' => 'required|numeric|integer|gte:0',
        'special' => 'nullable',
        'topicId' => 'nullable',
    ];

    protected $messages = [
        'title.unique' => 'The exam name already exists. Choose a different name',
        'quesLimit.required' => 'Question limit is required',
        'quesLimit.numeric' => 'Question limit has to be a number',
        'quesLimit.integer' => 'Question limit has to be a integer',
        'quesLimit.gte' => 'Question limit has to be greater than 0'
    ];

    public function saveExam()
    {
        if(!$this->special){
            $this->rules['topicId'] = 'required';
        }

        $this->rules['title'] = 'required|string|max:325|unique:exams,title,'.$this->exam->id;

        if($this->showQuestionLimit2){
            $this->rules['quesLimit'] = 'required|numeric|integer|gte:0';
            $this->rules['quesLimit_2'] = 'required|numeric|integer|gte:0';

            $this->messages['quesLimit.required'] = 'MCQ Question limit is required';
            $this->messages['quesLimit.numeric'] = 'MCQ Question limit has to be a number';
            $this->messages['quesLimit.integer'] = 'MCQ Question limit has to be a integer';
            $this->messages['quesLimit.gte'] = 'MCQ Question limit has to be greater than 0';

            $this->messages['quesLimit_2.required'] = 'CQ Question limit is required';
            $this->messages['quesLimit_2.numeric'] = 'CQ Question limit has to be a number';
            $this->messages['quesLimit_2.integer'] = 'CQ Question limit has to be a integer';
            $this->messages['quesLimit_2.gte'] = 'CQ Question limit has to be greater than 0';
        }
        else{
            $this->rules['quesLimit'] = 'required|numeric|integer|gte:0';

            $this->messages['quesLimit.required'] = 'Question limit is required';
        }

        $data = $this->validate();

        if($this->quesLimit < 1 && $this->quesLimit_2 < 1){
            $this->addError('quesLimit', 'Both MCQ and CQ question limits cannot be empty');
            $this->addError('quesLimit_2', 'Both MCQ and CQ question limits cannot be empty');

            return;
        }

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
        $exam->threshold_marks = $data['threshold_marks'];
        $exam->question_limit = $data['quesLimit'];
        if($this->showQuestionLimit2){
            $exam->question_limit_2 = $data['quesLimit_2'];
        }

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
        $this->threshold_marks = $this->exam->threshold_marks;
        $this->quesLimit = $this->exam->question_limit;
        if($this->examType == "Pop Quiz" || $this->examType == "Topic End Exam"){
            $this->showQuestionLimit2 = true;
        }
        $this->quesLimit_2 = $this->exam->question_limit_2;
        $this->special = $this->exam->special;

        if ($this->special) {
            $this->show = false;
        } else {
            $this->show = true;
        }

        // $this->examType = ExamType::where('id', $this->examType)->first();
        $this->course = Course::where('id', $this->courseId)->first();

        $this->intermediaryLevel = IntermediaryLevel::where('id', $this->course->intermediary_level_id)->first();
        $this->intermediaryLevelId = $this->intermediaryLevel->id;

        $this->category = CourseCategory::where('id', $this->intermediaryLevel->course_category_id)->first();
        $this->categoryId = $this->category->id;
        
        // dd($this->course, $this->intermediaryLevel, $this->intermediaryLevelId, $this->categoryId);

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
