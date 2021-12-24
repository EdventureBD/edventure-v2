<?php

namespace App\Http\Livewire\Assignment;

use Livewire\Component;
use App\Models\Admin\Exam;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Admin\Assignment;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public $assignment;

    public $question;
    public $image;
    public $tempImage;
    public $marks;
    public $examId;

    public $exam;

    public function updatedImage()
    {
        $this->tempImage = $this->image;
    }

    protected $rules = [
        'question' => 'required|min:4',
        'image' => 'nullable|image|mimes:jpeg,jpg,png|max:4096',
        'examId' => 'required',
        'marks' => 'required|numeric'
    ];

    protected $messages = [
        'question.required' => 'Question cannot be empty',
        'question.min' => 'Question cannot be shorter than :min character',
        'examId.required' => 'Exam must be selected',
        'marks.required' => 'Marks must be filled',
    ];

    public function saveAssignment()
    {
        $data = $this->validate();
        if ($this->image) {
            $imageUrl = $this->image->store('public/question/assignment');
            $this->image = Storage::url($imageUrl);
        }

        $assignment = Assignment::find($this->assignment->id);
        $assignment->question = $data['question'];
        $assignment->slug = Str::slug($data['question']);
        $assignment->image = $this->image;
        $assignment->marks = $data['marks'];
        $assignment->exam_id = $data['examId'];

        $save = $assignment->save();
        $this->image = null;

        if ($save) {
            session()->flash('status', 'Assignment created successfully!');
            return redirect()->route('exam.show', $this->exam->slug);
        } else {
            session()->flash('failed', 'Assignment creation failed!');
            return redirect()->route('addQuestion');
        }
    }

    public function mount()
    {
        $this->question = $this->assignment->question;
        $this->image = $this->assignment->image;
        $this->marks = $this->assignment->marks;
        $this->examId = $this->assignment->exam_id;

        $this->exam = Exam::where('id', $this->assignment->exam_id)->first();
    }
    public function render()
    {
        return view('livewire.assignment.edit');
    }
}
