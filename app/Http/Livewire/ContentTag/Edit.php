<?php

namespace App\Http\Livewire\ContentTag;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Admin\Course;
use App\Models\Admin\ContentTag;
use App\Models\Admin\CourseTopic;
// use App\Models\Admin\CourseLecture;

class Edit extends Component
{
    use WithFileUploads;

    public $contentTag;

    public $title;
    public $courseId;
    public $topicId;
    // public $lectureId;

    public $course;
    public $topic;
    // public $lecture;
    public $solutionVideo;
    public $solutionPdf;
    public $prevpdf;

    public function updatedTitle()
    {
        $this->validate([
            'title' => 'required|string|max:325'
        ]);
    }

    public function updatedSolutionVideo()
    {
        $this->validate([
            'solutionVideo' => ['string', 'min:3'],
        ]);
    }

    public function updatedSolutionPdf()
    {
        $this->validate([
            'solutionPdf' => ['file', 'mimes:pdf', 'max:50000'],
        ]);
    }

    protected $rules = [
        'title' => 'required|string|max:325',
        'courseId' => 'required',
        'topicId' => 'required',
        // 'lectureId' => 'required',
    ];

    public function updateContentTag()
    {
        $data = $this->validate();
        $content_tag = ContentTag::find($this->contentTag->id);
        $content_tag->title = $data['title'];
        $content_tag->course_id = $data['courseId'];
        $content_tag->topic_id = $data['topicId'];
        // $content_tag->lecture_id = $data['lectureId'];
        if (!empty($this->solutionPdf)) {
            $fileName = "public/content_tags/pdf/" . substr($this->prevpdf, 26);
            Storage::delete($fileName);
            $content_tag->solution_pdf = Storage::url($this->solutionPdf->store('public/content_tags/pdf'));
        }
        $content_tag->solution_video = $this->solutionVideo;
        $content_tag->status = 1;
        $save = $content_tag->save();

        if ($save) {
            session()->flash('status', 'Content Tag successfully updated!');
            return redirect()->route('content-tag.index');
        } else {
            session()->flash('failed', 'Content Tag updated failed!');
            return redirect()->route('content-tag.create');
        }
    }

    public function mount()
    {
        $this->title = $this->contentTag->title;
        $this->courseId = $this->contentTag->course_id;
        $this->topicId = $this->contentTag->topic_id;
        // $this->lectureId = $this->contentTag->lecture_id;
        $this->prevpdf = $this->contentTag->solution_pdf;

        $this->course = Course::where('id', $this->courseId)->first();
        $this->topic = CourseTopic::where('id', $this->topicId)->first();
        // $this->lecture = CourseLecture::where('id', $this->lectureId)->first();
    }

    public function render()
    {
        return view('livewire.content-tag.edit');
    }
}
