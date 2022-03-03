<?php

namespace App\Http\Livewire\Student\Batch;

use App\Models\Admin\BatchExam;
use App\Models\Admin\CourseLecture;
use Livewire\Component;

class Lectures extends Component
{
    public $batchTopic;
    public $courseLectures;
    public $batch;
    public $exams;

    public function mount()
    {
        // $this->courseLectures = CourseLecture::join('batch_lectures', 'batch_lectures.topic_id', 'course_lectures.topic_id')
        //     ->where('batch_lectures.topic_id', $this->batchTopic)
        //     ->where('batch_lectures.status', 1)
        //     ->get();
        $this->courseLectures = CourseLecture::where('topic_id', $this->batchTopic)->get();
        $this->exams = BatchExam::join('exams', 'batch_exams.exam_id', 'exams.id')
            ->where('batch_exams.batch_id', $this->batch->id)
            ->where('exams.topic_id', $this->batchTopic)
            ->where('exams.special', null)
            ->where('batch_exams.status', 1)
            ->get();
    }

    public function render()
    {
        return view('livewire.student.batch.lectures');
    }
}
