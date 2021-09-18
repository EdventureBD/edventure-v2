<?php

namespace App\Http\Livewire\Student\User;

use Livewire\Component;
use App\Models\Student\exam\QuestionContentTagAnalysis;

class AnalysisSpecific extends Component
{
    public $questionContentTag;

    public $totalQuestionMarks = 0;
    public $gainMarks = 0;
    public $percent;

    public function overall()
    {
        // dd($this->questionContentTag);
        $specificTags = QuestionContentTagAnalysis::where('student_id', auth()->user()->id)
            ->where('content_tag_id', $this->questionContentTag->content_tag_id)
            ->get();

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

            // START OF CQ ANALYSIS
            if ($specificTag->exam_type == 'CQ') {
                $cqQuestionMark = $specificTag->cqQuestion->marks;
                $this->totalQuestionMarks = $this->totalQuestionMarks + $cqQuestionMark;
                $cqGainMarks = QuestionContentTagAnalysis::where('student_id', auth()->user()->id)
                    ->where('content_tag_id', $this->questionContentTag->content_tag_id)
                    ->where('exam_type', 'CQ')
                    ->sum('gain_marks');
                $this->gainMarks = $this->gainMarks + $cqGainMarks;
            }

            if ($this->totalQuestionMarks != 0) {
                $this->percent = round(($this->gainMarks * 100) / $this->totalQuestionMarks);
            }
        }
    }

    public function mount()
    {
        $this->overall();
    }

    public function render()
    {
        // dd($this->questionContentTag);
        return view('livewire.student.user.analysis-specific');
    }
}


// DON'T DELETE THIS PORTION ->IMPORTANT TO ENAN

    // // START OF MCQ ANALYSIS
    // if ($this->questionContentTag->exam_type === 'MCQ') {
    //     $mcqQuestionMark = QuestionContentTagAnalysis::where('student_id', auth()->user()->id)
    //         ->where('content_tag_id', $this->questionContentTag->content_tag_id)
    //         ->where('exam_type', 'MCQ')
    //         ->get()->count();
    //     $this->totalQuestionMarks = $this->totalQuestionMarks + $mcqQuestionMark;
    //     $mcqGainMarks = QuestionContentTagAnalysis::where('student_id', auth()->user()->id)
    //         ->where('content_tag_id', $this->questionContentTag->content_tag_id)
    //         ->where('exam_type', 'MCQ')
    //         ->sum('gain_marks');
    //     $this->gainMarks = $this->gainMarks + $mcqGainMarks;
    // }

    // // START OF CQ ANALYSIS
    // if ($this->questionContentTag->exam_type === 'CQ') {
    //     $cqQuestionMark = $this->questionContentTag->cqQuestion->marks;
    //     $this->totalQuestionMarks = $this->totalQuestionMarks + $cqQuestionMark;
    //     $cqGainMarks = QuestionContentTagAnalysis::where('student_id', auth()->user()->id)
    //         ->where('content_tag_id', $this->questionContentTag->content_tag_id)
    //         ->where('exam_type', 'CQ')
    //         ->sum('gain_marks');
    //     $this->gainMarks = $this->gainMarks + $cqGainMarks;
    // }

    // $this->percent = round(($this->gainMarks * 100) / $this->totalQuestionMarks);

// DON'T DELETE THIS PORTION ->IMPORTANT TO ENAN