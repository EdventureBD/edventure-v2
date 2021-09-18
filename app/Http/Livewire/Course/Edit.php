<?php

namespace App\Http\Livewire\Course;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Admin\Course;
use Livewire\WithFileUploads;
use App\Models\Admin\CourseCategory;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public $course;
    public $categories;

    public $title;
    public $description;
    public $price;
    public $categoryId;
    public $duration;
    public $url;
    public $image;
    public $tempImage;
    public $deleteImage;

    public function updatedTitle()
    {
        $this->validate([
            'title' => ['required', 'string', 'max:100'],
        ]);
    }

    public function updatedImage()
    {
        $this->tempImage = $this->image;
    }

    public function updatedDuration()
    {
        $this->validate([
            'duration' => 'required|numeric|between:1,36',
        ]);
    }

    public function updatedUrl()
    {
        $this->validate([
            'url' => ['nullable', 'string', 'min:3', 'max:9'],
        ]);
    }

    public function updatedCategoryId()
    {
        $this->validate([
            'categoryId' => 'required'
        ]);
    }

    public function updatedPrice()
    {
        $this->validate([
            'price' => 'required|integer|numeric'
        ]);
    }

    public function updatedDescription()
    {
        $this->validate([
            'description' => 'required|string|max:500'
        ]);
    }

    protected $rules = [
        'title' => ['required', 'string', 'max:100'],
        'image' => 'nullable',
        'description' => 'required|string|max:500',
        'url' => ['nullable', 'string', 'min:3', 'max:9'],
        'price' => 'required|integer|numeric',
        'categoryId' => 'required',
        'duration' => 'required|numeric|between:1,36',
    ];

    public function updateCourse()
    {
        $data = $this->validate();
        if ($this->tempImage) {
            $imageUrl = $this->image->store('public/course');
            $this->image = $imageUrl;
            Storage::delete($this->deleteImage);
        }
        $course = Course::find($this->course->id);
        $course->logo = $this->image;
        $course->title = $data['title'];
        $course->slug = Str::slug($data['title']);
        $course->course_category_id = $data['categoryId'];
        $course->description = $data['description'];
        $course->duration = $data['duration'];
        $course->trailer = $data['url'];
        $course->price = $data['price'];
        $save = $course->save();

        if ($save) {
            session()->flash('status', 'Course successfully added!');
            return redirect()->route('course.index');
        } else {
            session()->flash('failed', 'Course added failed!');
            return redirect()->route('course.edit', $this->course->id);
        }
    }

    public function mount()
    {
        $this->title = $this->course->title;
        $this->description = $this->course->description;
        $this->price = $this->course->price;
        $this->categoryId = $this->course->course_category_id;
        $this->duration = $this->course->duration;
        $this->url = $this->course->trailer;
        $this->image = $this->course->logo;
        $this->deleteImage = $this->course->logo;


        $this->categories = CourseCategory::all();
    }

    public function render()
    {
        return view('livewire.course.edit');
    }
}
