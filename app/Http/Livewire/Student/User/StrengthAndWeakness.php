<?php

namespace App\Http\Livewire\Student\User;

use Livewire\Component;
use App\Models\Student\exam\QuestionContentTagAnalysis;

class StrengthAndWeakness extends Component
{
    public $course;
    public $type;

    public $questionContentTags;

    public $totalQuestionMarks = 0;
    public $gainMarks = 0;
    public $percent;
    public $strengths = [];
    public $weaknesses = [];

    public function mount()
    {
        $this->questionContentTags = QuestionContentTagAnalysis::join('content_tags', 'question_content_tag_analyses.content_tag_id', 'content_tags.id')
            ->where('question_content_tag_analyses.student_id', auth()->user()->id)
            ->where('content_tags.course_id', $this->course->id)
            ->groupBy('question_content_tag_analyses.content_tag_id')
            ->select('question_content_tag_analyses.*', 'content_tags.title')
            ->get();
    }

    public function render()
    {
        return view('livewire.student.user.strength-and-weakness');
    }
}
