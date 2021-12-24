<?php

namespace App\Http\Livewire\Exam;

use App\Models\Admin\ContentTag;
use Livewire\Component;
use App\Models\Admin\MCQ as mcqques;
use App\Models\Admin\Exam;
use App\Models\Admin\QuestionContentTag;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Mcq extends Component
{
    use WithFileUploads;

    public $exam;

    public $question;
    public $image;
    public $field1;
    public $field2;
    public $field3;
    public $field4;
    public $answer;
    public $examId;

    public $contentTags;
    public $contentTagIds = [];

    protected $rules = [
        'question' => 'required|min:4',
        'image' => 'nullable|image|mimes:jpeg,jpg,png|max:4096',
        'field1' => 'required',
        'field2' => 'required',
        'field3' => 'required',
        'field4' => 'required',
        'answer' => 'required',
        'examId' => 'required',
        'contentTagIds' => 'required',
    ];

    protected $messages = [
        'question.required' => 'Question cannot be empty',
        'question.min' => 'Question cannot be shorter than :min character',
        'field1.required' => 'Option 1 cannot be empty',
        'field2.required' => 'Option 2 cannot be empty',
        'field3.required' => 'Option 3 cannot be empty',
        'field4.required' => 'Option 4 cannot be empty',
        'answer.required' => 'Answer cannot be empty',
        'examId.required' => 'Exam must be selected',
        'contentTagIds.required' => 'Content tag must be selected',
    ];

    public function saveMCQ()
    {
        $data = $this->validate();
        // dd($data);
        if ($this->image) {
            $imageUrl = $this->image->store('public/question/mcq');
            $this->image = $imageUrl;
        }

        $mcq = new mcqques();
        $mcq->question = $data['question'];
        $mcq->slug = Str::slug($data['question']);
        $mcq->image = $this->image;
        $mcq->field1 = $data['field1'];
        $mcq->field2 = $data['field2'];
        $mcq->field3 = $data['field3'];
        $mcq->field4 = $data['field4'];
        $mcq->answer = $data['answer'];
        $mcq->exam_id = $data['examId'];
        $mcq->number_of_attempt = 0;
        $mcq->gain_marks = 0;
        $mcq->success_rate = 0;

        $save = $mcq->save();

        $question_id = mcqques::latest()->first();

        if ($save) {
            $question_content_tag = new QuestionContentTag();
            $question_content_tag->exam_type = 'MCQ';
            $question_content_tag->question_id = $question_id->id;
            $question_content_tag->content_tag_id = implode(',', $this->contentTagIds);
            $question_content_tag->save();
            session()->flash('status', 'MCQ created successfully!');
            return redirect()->route('exam.show', $this->exam->slug);
        } else {
            session()->flash('failed', 'MCQ creation failed!');
            return redirect()->route('addQuestion');
        }
    }

    public function mount()
    {
        $this->examId = $this->exam->id;
        $this->contentTags = ContentTag::where('course_id', $this->exam->course_id)
            ->where('topic_id', $this->exam->topic_id)
            ->get();
    }
    public function render()
    {
        return view('livewire.exam.mcq');
    }
}
