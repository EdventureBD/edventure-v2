<?php

namespace App\Http\Livewire\Course;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

// models
use App\Models\Admin\Course;
use App\Models\Admin\Bundle;
use App\Models\Admin\Batch;
use App\Models\Admin\IntermediaryLevel;
use App\Models\User;

class Create extends Component
{
    use WithFileUploads;

    public $intermediary_levels;
    public $intermediaryLevelId;
    public $bundles;
    public $bundleId;
    public $teachers;
    public $teacherId;
    public $title;
    public $description;
    public $duration;
    public $price;
    public $image;
    public $banner;
    public $tempImage;
    public $tempBanner;
    public $url;
    public $show_price = true;
    public $show_teachers = false;

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
            'intermediaryLevelId' => 'required|numeric|integer'
        ]);
    }

    public function updatedBundleId()
    {
        if($this->bundleId){
            $this->show_price = false;
            $this->show_teachers = true;
        }
        else{
            $this->show_price = true;
            $this->show_teachers = false;
        }
        $this->validate([
           'bundleId' => 'nullable|numeric|integer'
        ]);
    }

    public function updatedTeacherId()
    {
       $this->validate([
            'teacherId' => 'required|numeric|integer'
       ]);
    }

    public function updatedPrice()
    {
      if($this->bundleId){
         $this->validate([
            'price' => 'required|numeric|integer|gt:0'
         ]);
      }
    }

    public function updatedDescription()
    {
        $this->validate([
            'description' => 'required|string|max:500'
        ]);
    }

    protected $rules = [
        'title' => 'required|string|max:100|unique:courses',
        'banner' => 'nullable|image|mimes:jpeg,jpg,png',
        'image' => 'nullable|mimes:jpeg,jpg,png',
        'description' => 'required|string|max:1000',
        'url' => ['nullable', 'string', 'min:3'],
        'intermediaryLevelId' => 'required|numeric|integer',
        'bundleId' => 'nullable|numeric|integer',
        'duration' => 'required|numeric|between:1,36',
    ];

    protected $messages = [
        'intermediaryLevelId.required' => 'Intermediary level is required.',
        'intermediaryLevelId.numeric' => 'Intermediary level has to be a numeric value.',
        'intermediaryLevelId.integer' => 'Intermediary level has to be a integer value.',
        'intermediaryLevelId.numeric' => 'Bundle has to be a numeric value.',
        'intermediaryLevelId.integer' => 'Bundle has to be a integer value.',
    ];

    public function saveCourse()
    { 
        if($this->bundleId){
            $this->rules['teacherId'] = 'required|integer|numeric';
            $this->rules['price'] = 'nullable|integer|numeric';
         }
         else{
            $this->rules['teacherId'] = 'nullable|integer|numeric';
            $this->rules['price'] = 'required|integer|numeric|gt:-1';
         }

        $data = $this->validate();

        if ($this->image) {
            $imageUrl = $this->image->store('public/course');
            $this->image = Storage::url($imageUrl);
        }
        if ($this->banner) {
            $imageUrl2 = $this->banner->store('public/course');
            $this->banner = Storage::url($imageUrl2);
        }

        $intermediary_level = IntermediaryLevel::where('id', $data['intermediaryLevelId'])->firstOrFail();

        $course = new Course();
        $course->title = $data['title'];
        $course->slug = Str::slug($data['title']);
        $course->icon = $this->image;
        $course->banner = $this->banner;
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
        $course->status = 1;
        $course->order = 0;
        $save = $course->save();

        if($course->bundle_id !== null){
            $bundle = Bundle::where('id', $course->bundle_id)->first();
            $batch = new Batch();
            $batch->title = 'batch for bundle name- '.$bundle->bundle_name.' bundle id- '.$bundle->id;
            $batch->slug = uniqid();
            $batch->batch_running_days = 0;
            $batch->teacher_id = $this->teacherId;
            $batch->student_limit = 10000;
            $batch->course_id = $course->id;
            $batch->status = 1;
            $batch->order = 0;
            $batch->save();
        }

        if ($save) {
            session()->flash('status', 'Course successfully added!');
            return redirect()->route('course.index');
        } else {
            session()->flash('failed', 'Course added failed!');
            return redirect()->route('course.create');
        }
    }

    public function mount()
    {
        $this->bundles = Bundle::all();
        $this->teachers = User::where('user_type', 2)->get();
    }

    public function render()
    {
        return view('livewire.course.create');
    }
}
