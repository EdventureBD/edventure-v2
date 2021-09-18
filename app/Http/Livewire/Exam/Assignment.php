<?php

namespace App\Http\Livewire\Exam;

use App\Models\Admin\Assignment as AdminAssignment;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Assignment extends Component
{
    use WithFileUploads;

    public $exam;

    public $question;
    public $image;
    public $marks;
    public $examId;

    public $loading;

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
            $this->image = $imageUrl;
        }

        $assignment = new AdminAssignment();
        $assignment->question = $data['question'];
        $assignment->slug = Str::slug($data['question']);
        $assignment->image = $this->image;
        $assignment->marks = $data['marks'];
        $assignment->exam_id = $data['examId'];

        $save = $assignment->save();

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
        $this->examId = $this->exam->id;
    }
    public function render()
    {
        return view('livewire.exam.assignment');
    }
}
