<?php

namespace App\Http\Livewire\Course;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Admin\Course;
use Livewire\WithFileUploads;
use App\Models\Admin\CourseCategory;
use Illuminate\Support\Facades\Storage;

class Create extends Component
{
    use WithFileUploads;

    public $intermediary_levels;
    public $intermediaryLevelId;
    public $title;
    public $description;
    public $duration;
    public $price;
    public $image;
    public $banner;
    public $tempImage;
    public $tempBanner;
    public $url;

    public function updatedTitle()
    {
        $this->validate([
            'title' => ['required', 'string', 'max:100', 'unique:courses'],
        ]);
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
            'url' => ['nullable', 'string', 'min:3'],
        ]);
    }

    public function updatedImage()
    {
        $this->tempImage = $this->image;
    }

    public function updatedBanner()
    {
        $this->tempBanner = $this->banner;
    }

    public function updatedIntermediaryLevelId()
    {
        $this->validate([
            'intermediaryLevelId' => 'required'
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
        'title' => ['required', 'string', 'max:100', 'unique:courses'],
        'banner' => 'nullable|image|mimes:jpeg,jpg,png',
        'image' => 'nullable|mimes:jpeg,jpg,png',
        'description' => 'required|string|max:1000',
        'url' => ['nullable', 'string', 'min:3'],
        'price' => 'required|integer|numeric|gt:0',
        'intermediaryLevelId' => 'required',
        'duration' => 'required|numeric|between:1,36',
    ];

    public function saveCourse()
    {
        $data = $this->validate();
        if ($this->image) {
            $imageUrl = $this->image->store('public/course');
            $this->image = Storage::url($imageUrl);
        }
        if ($this->banner) {
            $imageUrl2 = $this->banner->store('public/course');
            $this->banner = Storage::url($imageUrl2);
        }
        $course = new Course();
        $course->title = $data['title'];
        $course->slug = Str::slug($data['title']);
        $course->icon = $this->image;
        $course->banner = $this->banner;
        $course->intermediary_level_id = $data['intermediaryLevelId'];
        $course->description = $data['description'];
        $course->duration = $data['duration'];
        $course->trailer = $data['url'];
        $course->price = $data['price'];
        $course->status = 1;
        $course->order = 0;
        $save = $course->save();

        if ($save) {
            session()->flash('status', 'Course successfully added!');
            return redirect()->route('course.index');
        } else {
            session()->flash('failed', 'Course added failed!');
            return redirect()->route('course.create');
        }
    }

    public function render()
    {
        return view('livewire.course.create');
    }
}
