<?php

namespace App\Http\Livewire\QuestionContentTag;

use Livewire\Component;

class Edit extends Component
{
    public $questionContentTag;

    public $examId;
    public $questionId;
    public $contentTagId;

    public $exams;
    public $questions;
    public $contentTags;

    public $examType;

    public function mount()
    {
        // dd($this->questionContentTag);
        $this->examType = $this->questionContentTag->exam_type;
        $this->questionId = $this->questionContentTag->question_id;
        $this->contentTagId = $this->questionContentTag->content_tag_id;
    }

    public function render()
    {
        return view('livewire.question-content-tag.edit');
    }
}
