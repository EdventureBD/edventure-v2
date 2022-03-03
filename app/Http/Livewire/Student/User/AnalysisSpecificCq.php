<?php

namespace App\Http\Livewire\Student\User;

use Livewire\Component;
use App\Models\Student\exam\QuestionContentTagAnalysis;

class AnalysisSpecificCq extends Component
{
    public $type;
    public $questionContentTag;

    public $totalQuestionMarks = 0;
    public $gainMarks = 0;
    public $percent;

    public function cq()
    {
        // dd($this->questionContentTag);
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
        }
    }

    public function mount()
    {
        $this->cq();
    }

    public function render()
    {
        return view('livewire.student.user.analysis-specific-cq');
    }
}
