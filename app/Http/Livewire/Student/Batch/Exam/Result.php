<?php

namespace App\Http\Livewire\Student\Batch\Exam;

use Livewire\Component;
use App\Models\Admin\MCQ;
use App\Models\Admin\QuestionContentTag;
use App\Models\Student\exam\DetailsResult;
use App\Models\Student\exam\QuestionContentTagAnalysis;

class Result extends Component
{
    public $question;
    public $answers;
    public $index;
    public $exam;
    public $batch;

    public $specific;

    public function mount()
    {
        $this->question = MCQ::Where('id', $this->question)->first();

        if ($this->question->answer == 1) {
            $this->specific = $this->question->field1;
        } elseif ($this->question->answer == 2) {
            $this->specific = $this->question->field2;
        } elseif ($this->question->answer == 3) {
            $this->specific = $this->question->field3;
        } elseif ($this->question->answer == 4) {
            $this->specific = $this->question->field4;
        }

        $details_result = new DetailsResult();
        $details_result->exam_id = $this->exam->id;
        $details_result->exam_type = $this->exam->exam_type;
        $details_result->question_id = $this->question->id;
        $details_result->batch_id = $this->batch->id;
        $details_result->student_id = auth()->user()->id;
        for ($j = 1; $j <= sizeOf($this->answers); $j++) {
            if (array_key_exists($j, $this->answers)) {
                if ($this->index == $j) {
                    if ($this->answers[$j] == $this->question->field1) {
                        if ($this->answers[$j] == $this->specific) {
                            $details_result->gain_marks = 1;
                        } else {
                            $details_result->gain_marks = 0;
                        }
                    } else if ($this->answers[$j] == $this->question->field2) {
                        if ($this->answers[$j] == $this->specific) {
                            $details_result->gain_marks = 1;
                        } else {
                            $details_result->gain_marks = 0;
                        }
                    } else if ($this->answers[$j] == $this->question->field3) {
                        if ($this->answers[$j] == $this->specific) {
                            $details_result->gain_marks = 1;
                        } else {
                            $details_result->gain_marks = 0;
                        }
                    } else if ($this->answers[$j] == $this->question->field4) {
                        if ($this->answers[$j] == $this->specific) {
                            $details_result->gain_marks = 1;
                        } else {
                            $details_result->gain_marks = 0;
                        }
                    }
                }
            }
        }
        $details_result->status = 1;
        $details_result->save();

        $questionContentTags = QuestionContentTag::where('question_id', $this->question->id)->get();
        if ($questionContentTags->count() > 0) {
            foreach ($questionContentTags as $questionContentTag) {
                $questionContentTagAnalysis = new QuestionContentTagAnalysis();
                $questionContentTagAnalysis->content_tag_id = $questionContentTag->content_tag_id;
                $questionContentTagAnalysis->student_id = auth()->user()->id;
                $questionContentTagAnalysis->exam_type = 'MCQ';
                $questionContentTagAnalysis->question_id = $this->question->id;
                $questionContentTagAnalysis->number_of_attempt = 1;
                for ($j = 1; $j <= sizeOf($this->answers); $j++) {
                    if (array_key_exists($j, $this->answers)) {
                        if ($this->index == $j) {
                            if ($this->answers[$j] == $this->question->field1) {
                                if ($this->answers[$j] == $this->specific) {
                                    $questionContentTagAnalysis->gain_marks = 1;
                                } else {
                                    $questionContentTagAnalysis->gain_marks = 0;
                                }
                            } else if ($this->answers[$j] == $this->question->field2) {
                                if ($this->answers[$j] == $this->specific) {
                                    $questionContentTagAnalysis->gain_marks = 1;
                                } else {
                                    $questionContentTagAnalysis->gain_marks = 0;
                                }
                            } else if ($this->answers[$j] == $this->question->field3) {
                                if ($this->answers[$j] == $this->specific) {
                                    $questionContentTagAnalysis->gain_marks = 1;
                                } else {
                                    $questionContentTagAnalysis->gain_marks = 0;
                                }
                            } else if ($this->answers[$j] == $this->question->field4) {
                                if ($this->answers[$j] == $this->specific) {
                                    $questionContentTagAnalysis->gain_marks = 1;
                                } else {
                                    $questionContentTagAnalysis->gain_marks = 0;
                                }
                            }
                        }
                    }
                }
                $questionContentTagAnalysis->status = 1;
                $questionContentTagAnalysis->save();
            }
        }
    }

    public function render()
    {
        return view('livewire.student.batch.exam.result');
    }
}
