<?php

namespace App\Http\Livewire\LiveClass;

use Livewire\Component;
use App\Models\Admin\Batch;
use App\Models\Admin\LiveClass;
use App\Models\Admin\CourseTopic;

class Edit extends Component
{
    public $liveClass;

    public $title;
    public $batchId;
    public $categoryId;
    // public $course_id;
    public $topicId;
    public $liveLink;
    public $startTime;
    public $startDate;
    public $isSpecial;

    public $batch;
    public $courses;
    public $topics = [];

    public function updatedTitle()
    {
        $this->validate([
            'title' => 'required|string|max:200'
        ]);
    }

    public function updatedBatchId()
    {
        // $courseId = Batch::select('course_id')->where('id', $this->batchId)->first();
        // $this->course_id = $courseId->course_id;
        $this->validate([
            'batchId' => 'required'
        ]);
    }

    public function updatedTopicId()
    {
        // dd($this->topicId);
        $this->validate([
            'topicId' => 'required'
        ]);
    }

    public function updatedliveLink()
    {
        $this->validate([
            'liveLink' => 'required|url'
        ]);
    }

    public function updatedStartTime()
    {
        $this->validate([
            'startTime' => 'required'
        ]);
    }

    public function updatedStartdate()
    {
        $this->validate([
            'startDate' => 'required|date|'
        ]);
    }

    public function updatedisSpecial()
    {
        if ($this->isSpecial) {
            $this->topicId = null;
        }
    }

    protected $rules = [
        'title' => 'required|string|max:200',
        'batchId' => 'required',
        'topicId' => 'nullable',
        'liveLink' => 'required|url',
        'startTime' => 'required|',
        'startDate' => 'required|date|',
        'isSpecial' => 'nullable',
        // 'course_id' => 'required'
    ];

    public function updateLiveClass()
    {
        $data = $this->validate();
        $live_class = LiveClass::find($this->liveClass->id);
        $live_class->title = $data['title'];

        $live_class->batch_id = $data['batchId'];
        $live_class->topic_id = $data['topicId'];
        $live_class->start_time = $data['startTime'];
        $live_class->start_date = $data['startDate'];
        $live_class->live_link = $data['liveLink'];
        $live_class->is_special = $data['isSpecial'];
        // $live_class->course_id = $data['course_id'];

        $save = $live_class->save();

        if ($save) {
            session()->flash('status', 'Live class successfully updated!');
            return redirect()->route('live-class.index');
        } else {
            session()->flash('failed', 'Live class update failed!');
            return redirect()->route('live-class.edit');
        }
    }

    public function mount()
    {
        // dd($this->liveClass);
        $this->title = $this->liveClass->title;
        $this->batchId = $this->liveClass->batch_id;
        // $this->course_id = $this->liveClass->course_id;
        $this->topicId = $this->liveClass->topic_id;
        $this->liveLink = $this->liveClass->live_link;
        $this->startTime = $this->liveClass->start_time;
        $this->startDate = $this->liveClass->start_date;
        $this->isSpecial = $this->liveClass->is_special;

        $this->batch = Batch::find($this->batchId);
    }

    public function render()
    {
        if (!empty($this->batchId)) {
            $batch_data = Batch::select('course_id')->where('id', $this->batchId)->first();
            $this->topics = CourseTopic::where('course_id', $batch_data->course_id)->get();
        }

        return view('livewire.live-class.edit');
    }
}
