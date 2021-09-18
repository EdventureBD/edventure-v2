<?php

namespace App\Http\Livewire\QuestionContentTag;

use Livewire\Component;
use App\Models\Admin\CQ;
use App\Models\Admin\MCQ;
use App\Models\Admin\Exam;
use App\Models\Admin\Assignment;
use App\Models\Admin\ContentTag;
use App\Models\Admin\QuestionContentTag;

class Create extends Component
{
    public $examId;
    public $questionId;
    public $contentTagId;

    public $exams;
    public $questions;
    public $contentTags;

    public $examType;

    protected $rules = [
        'examId' => 'required',
        'questionId' => 'required',
        'contentTagId' => 'required',
    ];

    public function saveQuestionContentTag()
    {
        $data = $this->validate();
        $questionContentTag = new QuestionContentTag();
        $questionContentTag->exam_type = $this->examType->exam_type;
        $questionContentTag->question_id = $data['questionId'];
        $questionContentTag->content_tag_id = $data['contentTagId'];
        $questionContentTag->save();
        return redirect()->route('question-content-tag.index');
    }

    public function mount()
    {
        $this->exams = Exam::orderBy('title')->get();
    }

    public function render()
    {
        if (!empty($this->exams)) {
            $this->examType = Exam::where('id', $this->examId)->first();
        }
        if (!empty($this->examType)) {
            $this->contentTags = ContentTag::where('topic_id', $this->examType->topic_id)->get();
            if ($this->examType->exam_type === 'Assignment') {
                $this->questions = Assignment::where('exam_id', $this->examId)->get();
            } else if ($this->examType->exam_type === 'CQ') {
                $this->questions = CQ::where('exam_id', $this->examId)->get();
            } else if ($this->examType->exam_type === 'MCQ') {
                $this->questions = MCQ::where('exam_id', $this->examId)->get();
            }
        }
        return view('livewire.question-content-tag.create');
    }
}
