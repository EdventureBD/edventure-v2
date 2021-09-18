<?php

namespace App\Http\Livewire\CourseCategory;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Admin\CourseCategory;

class Create extends Component
{
    public $title;
    public $saved;
    public $message;

    public function updatedTitle()
    {
        $this->validate([
            'title' => 'required|string|max:50'
        ]);
    }

    public function saveCategory()
    {
        $data = $this->validate([
            'title' => 'required|string|max:50'
        ]);
        $courseCategory = new CourseCategory;
        $courseCategory->title = $data['title'];
        $courseCategory->slug = Str::slug($data['title']);
        $courseCategory->status = 1;
        $courseCategory->order = 0;
        $save = $courseCategory->save();

        if ($save) {
            session()->flash('status', 'Course Category successfully added!');
            return redirect()->route('course-category.index');
        } else {
            session()->flash('failed', 'Course Category added failed!');
            return redirect()->route('course-category.create');
        }
    }

    public function render()
    {
        return view('livewire.course-category.create');
    }
}
