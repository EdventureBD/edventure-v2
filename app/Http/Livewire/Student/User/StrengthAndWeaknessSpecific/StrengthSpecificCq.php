<?php

namespace App\Http\Livewire\Student\User\StrengthAndWeaknessSpecific;

use Livewire\Component;
use App\Models\Student\exam\QuestionContentTagAnalysis;

class StrengthSpecificCq extends Component
{
    public $questionContentTag;

    public $totalQuestionMarks = 0;
    public $gainMarks = 0;
    public $percent;
    public $strength;

    public function overall()
    {
        $specificTags = QuestionContentTagAnalysis::where('student_id', auth()->user()->id)
            ->where('content_tag_id', $this->questionContentTag->content_tag_id)
            ->get();

        foreach ($specificTags as $key => $specificTag) {
            // START OF CQ ANALYSIS
            if ($key == 0) {
                if ($specificTag->exam_type == 'CQ') {
                    $cqQuestionMark = $specificTag->cqQuestion->marks;
                    $this->totalQuestionMarks = $this->totalQuestionMarks + $cqQuestionMark;
                    $cqGainMarks = QuestionContentTagAnalysis::where('student_id', auth()->user()->id)
                        ->where('content_tag_id', $this->questionContentTag->content_tag_id)
                        ->where('exam_type', 'CQ')
                        ->sum('gain_marks');
                    $this->gainMarks = $this->gainMarks + $cqGainMarks;
                }
            }

            if ($this->totalQuestionMarks != 0) {
                $this->percent = round(($this->gainMarks * 100) / $this->totalQuestionMarks);
            }

            if ($this->percent >= 80) {
                $this->strength = $this->questionContentTag->title;
            }
        }
    }

    public function mount()
    {
        $this->overall();
    }

    public function render()
    {
        return view('livewire.student.user.strength-and-weakness-specific.strength-specific-cq');
    }
}
