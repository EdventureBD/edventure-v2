<?php

namespace App\Console\Commands;

use App\Models\Admin\Batch;
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
        foreach ($batches as $batch) {
            $allResultOfBatch = ExamResult::where('batch_id', $batch->id)
                ->groupby('student_id')
                ->sum('gain_marks');
        }
        return $batches;
    }
}
