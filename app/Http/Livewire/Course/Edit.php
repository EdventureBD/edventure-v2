<?php

namespace App\Http\Livewire\Course;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Admin\Course;
use App\Models\Admin\IntermediaryLevel;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public $course;
    public $categories;

    public $title;
    public $description;
    public $price;
    public $intermediaryLevelId;
    public $duration;
    public $url;
    public $image;
    public $banner;
    public $tempImage;
    public $tempBanner;
    public $deleteImage;
    public $deleteBanner;

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

    public function updatedBanner()
    {
        $this->tempBanner = $this->banner;
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
        'title' => ['required', 'string', 'max:100'],
        'description' => 'required|string|max:500',
        'url' => ['nullable', 'string', 'min:3'],
        'price' => 'required|integer|numeric|gt:-1',
        'intermediaryLevelId' => 'required',
        'duration' => 'required|numeric|between:1,36',
    ];

    public function updateCourse()
    {
        $data = $this->validate();
        if ($this->tempImage) {
            $imageUrl = $this->image->store('public/course');
            $this->image = Storage::url($imageUrl);
            Storage::delete($this->deleteImage);
        }
        
        if ($this->tempBanner) {
            $imageUrl2 = $this->banner->store('public/course');
            $this->banner = Storage::url($imageUrl2);;
            Storage::delete($this->deleteBanner);
        }
        $course = Course::find($this->course->id);
        $course->icon = $this->image;
        $course->banner = $this->banner;
        $course->title = $data['title'];
        $course->slug = Str::slug($data['title']);
        $course->intermediary_level_id = $data['intermediaryLevelId'];
        $course->description = $data['description'];
        $course->duration = $data['duration'];
        $course->trailer = $data['url'];
        $course->price = $data['price'];
        $save = $course->save();

        if ($save) {
            session()->flash('status', 'Course successfully updated!');
            return redirect()->route('course.index');
        } else {
            session()->flash('failed', 'Course added updated!');
            return redirect()->route('course.edit', $this->course->id);
        }
    }

    public function mount()
    {
        $this->title = $this->course->title;
        $this->description = $this->course->description;
        $this->price = $this->course->price;
        $this->intermediaryLevelId = $this->course->intermediary_level_id;
        $this->duration = $this->course->duration;
        $this->url = $this->course->trailer;
        $this->image = $this->course->icon;
        $this->banner = $this->course->banner;
        $this->deleteImage = $this->course->logo;
        $this->deleteBanner = $this->course->banner;
        $this->intermediary_levels = IntermediaryLevel::all();
    }

    public function render()
    {
        return view('livewire.course.edit');
    }
}
