<?php

namespace App\Http\Livewire\Course;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

// models
use App\Models\Admin\Course;
use App\Models\Admin\IntermediaryLevel;
use App\Models\Admin\Bundle;

class Edit extends Component
{
    use WithFileUploads;

    public $course;
    public $categories;

    public $title;
    public $description;
    public $price;
    public $intermediaryLevelId;
    public $bundles;
    public $bundleId;
    public $duration;
    public $url;
    public $image;
    public $banner;
    public $tempImage;
    public $tempBanner;
    public $deleteImage;
    public $deleteBanner;
    public $show_price;

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
            'intermediaryLevelId' => 'required|numeric|integer'
        ]);
    }

    public function updatedBundleId()
    {
        if($this->bundleId){
            $this->show_price = false;
            $this->validate([
                'bundleId' => 'required|numeric|integer'
            ]);
        }
        else{
            $this->show_price = true;
            $this->validate([
                'bundleId' => 'nullable|numeric|integer'
            ]);
        }
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
        'intermediaryLevelId' => 'required|numeric|integer',
        'bundleId' => 'nullable|numeric|integer',
        'price' => 'nullable|integer|numeric|gt:-1',
        'duration' => 'required|numeric|between:1,36',
    ];

    protected $messages = [
        'intermediaryLevelId.required' => 'Intermediary level is required.',
        'intermediaryLevelId.numeric' => 'Intermediary level has to be a numeric value.',
        'intermediaryLevelId.integer' => 'Intermediary level has to be a integer value.',
        'intermediaryLevelId.numeric' => 'Bundle has to be a numeric value.',
        'intermediaryLevelId.integer' => 'Bundle has to be a integer value.',
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

        $intermediary_level = IntermediaryLevel::where('id', $data['intermediaryLevelId'])->firstOrFail();

        $course = Course::find($this->course->id);
        $course->icon = $this->image;
        $course->banner = $this->banner;
        $course->title = $data['title'];
        $course->slug = Str::slug($data['title']);
        $course->course_category_id = $intermediary_level->course_category_id;
        $course->intermediary_level_id = $data['intermediaryLevelId'];
        if(empty($data['bundleId'])){
            $course->bundle_id = null;
        }
        else{
            $course->bundle_id = $data['bundleId'];
        }
        $course->description = $data['description'];
        $course->duration = $data['duration'];
        $course->trailer = $data['url'];
        if($this->bundleId){
            $course->price = 0;
        }
        else{
            $course->price = $data['price'];
        }
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
        $this->bundleId = $this->course->bundle_id;
        $this->duration = $this->course->duration;
        $this->url = $this->course->trailer;
        $this->image = $this->course->icon;
        $this->banner = $this->course->banner;
        $this->deleteImage = $this->course->logo;
        $this->deleteBanner = $this->course->banner;

        if($this->course->bundle_id !== null){
            $this->show_price = false;
        }

        $this->intermediary_levels = IntermediaryLevel::all();
        $this->bundles = Bundle::all();
    }

    public function render()
    {
        return view('livewire.course.edit');
    }
}
