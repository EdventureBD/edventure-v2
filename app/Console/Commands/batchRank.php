<?php

namespace App\Console\Commands;

use App\Models\Admin\Batch;
use App\Models\Admin\BatchStudentEnrollment;
use App\Models\Student\exam\ExamResult;
use Illuminate\Console\Command;

class batchRank extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:batch-rank';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updating batch rank';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $batches = Batch::where('status', 1)->get();
        $batch_results = [];
        foreach ($batches as $batch) {
            $batch_exam_results = ExamResult::where('batch_id', $batch->id)->get();
            $batch_results[$batch->id] = [];
            foreach ($batch_exam_results as $result) {
                if (!isset($batch_results[$batch->id][$result->student_id])) {
                    $batch_results[$batch->id][$result->student_id] = 0;
                }
                $batch_results[$batch->id][$result->student_id] += $result->gain_marks;
            }
        }
        foreach ($batch_results as $batch_id => $result) {
            if (!empty($result)) {
                arsort($result);
                $rank = 1;
                foreach ($result as $student_id => $marks) {
                    $batchStudentEnrollment = (new BatchStudentEnrollment())->where('student_id', $student_id)->where('batch_id', $batch_id)->first();
                    $batchStudentEnrollment->batch_rank = $rank;
                    $batchStudentEnrollment->save();
                    $rank++;
                }
            }
        }
        exit;
    }
}
