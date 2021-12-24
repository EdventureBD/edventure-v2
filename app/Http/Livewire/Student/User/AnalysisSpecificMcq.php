<?php

namespace App\Http\Livewire\Student\User;

use Livewire\Component;
use App\Models\Student\exam\QuestionContentTagAnalysis;

class AnalysisSpecificMcq extends Component
{
    public $type;
    public $questionContentTag;

    public $totalQuestionMarks = 0;
    public $gainMarks = 0;
    public $percent;

    public function mcq()
    {
        // dd($this->questionContentTag);
        $specificTags = QuestionContentTagAnalysis::where('student_id', auth()->user()->id)
            ->where('content_tag_id', $this->questionContentTag->content_tag_id)
            ->get();
        // dd($specificTags);

        foreach ($specificTags as $key => $specificTag) {
            // START OF MCQ ANALYSIS
            if ($key == 0) {
                if ($specificTag->exam_type == 'MCQ') {
                    $mcqQuestionMark = QuestionContentTagAnalysis::where('student_id', auth()->user()->id)
                        ->where('content_tag_id', $this->questionContentTag->content_tag_id)
                        ->where('exam_type', 'MCQ')
                        ->get()->count();
                    $this->totalQuestionMarks = $this->totalQuestionMarks + $mcqQuestionMark;
                    $mcqGainMarks = QuestionContentTagAnalysis::where('student_id', auth()->user()->id)
                        ->where('content_tag_id', $this->questionContentTag->content_tag_id)
                        ->where('exam_type', 'MCQ')
                        ->sum('gain_marks');
                    $this->gainMarks = $this->gainMarks + $mcqGainMarks;
                }
            }

            if ($this->totalQuestionMarks != 0) {
                $this->percent = round(($this->gainMarks * 100) / $this->totalQuestionMarks);
            }
        }
    }

    public function mount()
    {
        $this->mcq();
    }


    public function render()
    {
        return view('livewire.student.user.analysis-specific-mcq');
    }
}
