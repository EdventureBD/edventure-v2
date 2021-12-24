<?php

namespace App\Http\Livewire\Batch;

use Livewire\Component;
use App\Models\Admin\Batch;
use App\Models\Admin\BatchStudentEnrollment;

class Increment extends Component
{
    public $batch_running_days;
    public $batch_id;
    public $possible = false;

    public function up()
    {
        $this->batch_running_days = $this->batch_running_days + 1;
        $save = $this->updatebatch_running_days();
        if ($save) {
            $individual_batch_days = BatchStudentEnrollment::where('batch_id', $this->batch_id)->get();
            foreach ($individual_batch_days as $individual_batch_days) {
                $individual_batch_days->individual_batch_days = $individual_batch_days->individual_batch_days + 1;
                $individual_batch_days->save();
            }
        }
    }

    public function down()
    {
        if ($this->batch_running_days > 1) {
            $this->batch_running_days = $this->batch_running_days - 1;
            $save = $this->updatebatch_running_days();
            if ($save) {
                $individual_batch_days = BatchStudentEnrollment::where('batch_id', $this->batch_id)->get();
                foreach ($individual_batch_days as $individual_batch_days) {
                    $individual_batch_days->individual_batch_days = $individual_batch_days->individual_batch_days - 1;
                    $individual_batch_days->save();
                }
            }
        } else {
            $this->possible = true;
        }
    }

    public function updatebatch_running_days()
    {
        $days = Batch::find($this->batch_id);
        $days->batch_running_days = $this->batch_running_days;
        $save = $days->save();
        return $save;
    }

    public function render()
    {
        return view('livewire.batch.increment');
    }
}
