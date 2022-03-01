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
    public $quesLimit_2;
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
    public $threshold_marks;
    // public $examTypes;

    public $showAssignment = true;
    // public $showSpecialExam = true;

    public $showQuestionLimit = true;

    public $showQuestionLimit2 = false;

    public $showOrder = false;

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
            'order' => 'numeric|integer|gte:0'
        ]);
    }

    public function updatedThreshold_marks()
    {
        $this->validate([
            'threshold_marks' => 'required|numeric|integer|gte:0'
        ]);
    }

    public function updatedExamType()
    {
        if (($this->examType) == 'Assignment') {
            $this->quesLimit = 0;
            $this->showQuestionLimit = false;
            $this->showQuestionLimit2 = false;
            // $this->showSpecialExam = false;
            $this->marks=10;
            $this->duration=1440;
        } 
        elseif( ($this->examType) == 'MCQ' || ($this->examType) == 'Aptitude Test') {
            $this->quesLimit = '';
            $this->showQuestionLimit = true;
            $this->showQuestionLimit2 = false;
            $this->showOrder = false;
            // $this->showSpecialExam = true;
            $this->marks=null;
            $this->validate([
                'examType' => 'required'
            ]);
            $this->duration=null;
        } 
        elseif ( ($this->examType) == 'Pop Quiz'){
            $this->showQuestionLimit2 = true;
            $this->showOrder = true;
        }
        elseif ( ($this->examType) == 'Topic End Exam'){
            $this->showQuestionLimit2 = true;
            $this->showOrder = false;
        }
        elseif( ($this->examType) == 'CQ' ){
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
        'title' => 'required|string|max:325|unique:exams',
        'courseId' => 'required',
        'topicId' => 'nullable',
        'examType' => 'required',
        'marks' => 'required|numeric|integer|gt:0',
        'duration' => 'required|numeric|integer|gt:0',
        // 'order' => 'required|numeric|integer|gte:0',
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

        if($this->examType === "Pop Quiz"){
            $this->rules['order'] = 'required|numeric|integer|gte:0';
        }

        // $this->rules['title'] = 'required|string|max:325|unique:exams,title,'.$this->exam->id;

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
        
        // if test type is aptitude test and an aptitude test already exists
        if($this->examType == 'Aptitude Test'){
            $aptitude_test = Exam::where('exam_type', 'Aptitude Test')->where('course_id', $this->courseId)->where('topic_id', $this->topicId)->count();
            if($aptitude_test){
                $this->addError('aptitude_test_exists', 'An aptitude test for this island(i.e course topic) already exists !!');
                return;
            }
        }

        // if test type is aptitude test and an topic end exam test already exists
        if($this->examType == 'Topic End Exam'){
            $topic_end_exam = Exam::where('exam_type', 'Topic End Exam')->where('course_id', $this->courseId)->where('topic_id', $this->topicId)->count();
            if($topic_end_exam){
                $this->addError('topic_end_exam_exists', 'A topic end exam for this island(i.e course topic) already exists !!');
                return;
            }
        }

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
        if($this->examType == "Pop Quiz"){
            $exam->order = $data['order'];
        }
        else{
            $exam->order = 0;
        }
        $exam->threshold_marks = $data['threshold_marks'];
        $exam->question_limit = $data['quesLimit'];
        if($this->showQuestionLimit2){
            $exam->question_limit_2 = $data['quesLimit_2'];
        }

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
