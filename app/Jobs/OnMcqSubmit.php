<?php

namespace App\Jobs;

use App\Models\McqMarkingDetail;
use App\Models\McqQuestion;
use App\Models\McqTotalResult;
use App\Models\ModelMcqQuestionAnalysis;
use App\Models\ModelMcqTagAnalysis;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OnMcqSubmit implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $mcq;
    public $exam;
    public $exam_end_time;
    public $student_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mcq, $exam, $exam_end_time, $student_id)
    {
        $this->mcq = $mcq;
        $this->exam = $exam;
        $this->exam_end_time = $exam_end_time;
        $this->student_id = $student_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $detail_result = [];
        $tag_detail_analysis = [];
        $mcq_question_analysis = [];
        $total_marks = 0;
        $questions = McqQuestion::query()->where('model_exam_id',$this->exam->id)->get();
        $questionAnalysis = ModelMcqQuestionAnalysis::query()->where('model_exam_id',$this->exam->id)->get();
        foreach ($this->mcq as $key => $value) {
            $mcqQuestion = $questions->where('id',$key)->first();
            $gain_mark = $mcqQuestion->answer == $value ? 1
                                                        : (empty($value) ? 0
                                                        : ($this->exam->negative_marking ? -$this->exam->negative_marking_value  : 0));
            $detail_result[] = [
                'model_exam_id' => (int)$this->exam->id,
                'mcq_question_id' => $key,
                'student_id' => $this->student_id,
                'mcq_ans' => (int)$value,
                'gain_marks' => $gain_mark,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $tag_detail_analysis[] = [
                'model_exam_id' => (int)$this->exam->id,
                'mcq_question_id' => $key,
                'student_id' => $this->student_id,
                'exam_tag_id' => $mcqQuestion->exam_tag_id,
                'gain_marks' => $gain_mark,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $qtnAnalysis = count($questionAnalysis) > 0 ? $questionAnalysis->where('mcq_question_id',$key)->first() : null;
            $attempted = $qtnAnalysis ? $qtnAnalysis->attempted + 1 : 1;
            $correct = $qtnAnalysis ? $qtnAnalysis->correct + $gain_mark : 1;

            ModelMcqQuestionAnalysis::query()->updateOrCreate(
                ['mcq_question_id' => $key],
                [
                    'model_exam_id' => (int) $this->exam->id,
                    'mcq_question_id' => $key,
                    'attempted' => $attempted,
                    'correct' => $correct
                ]
            );


        }

        foreach ($detail_result as $key => $value) {
            $total_marks +=  $value['gain_marks'];
        }
        $total_result = [
            'model_exam_id' => (int) $this->exam->id,
            'student_id' => $this->student_id,
            'exam_end_time' => $this->exam_end_time,
            'total_marks' => $total_marks > 0 ? $total_marks : 0,
            'duration' => $this->exam->duration * 60
        ];

        McqMarkingDetail::query()->insert($detail_result);
        ModelMcqTagAnalysis::query()->insert($tag_detail_analysis);
        McqTotalResult::query()->create($total_result);
    }
}
