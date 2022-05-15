<?php

namespace App\Http\Livewire\CourseCategory;

use App\Models\Admin\CourseCategory;
use Livewire\Component;

class Edit extends Component
{
    public $category;
    public $status;
    public $title;

    public function updatedTitle()
    {
        $this->validate([
            'title' => ['required', 'string', 'max:325'],
        ]);
    }

    public function updatedStatus()
    {
        $this->validate([
            'status' => ['required', 'numeric', 'integer', 'gte:0'],
        ]);
    }

    protected $rules = [
        'title' => ['required', 'string', 'max:325'],
        'status' => ['required', 'numeric', 'integer', 'gte:0']
    ];

    public function updateCourseCategory()
    {
        $data = $this->validate();
        $category = CourseCategory::find($this->category->id);
        $category->title = $data['title'];
        $category->status = $data['status'];
        $save = $category->save();

        if ($save) {
            session()->flash('status', 'Category successfully updated!');
            return redirect()->route('course-category.index');
        } else {
            session()->flash('failed', 'Course Category added failed!');
            return redirect()->route('course-category.edit');
        }
    }

    public function mount()
    {
        $this->title = $this->category->title;
        $this->status = $this->category->status;
    }

    public function render()
    {
        return view('livewire.course-category.edit');
    }
}
