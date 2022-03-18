<?php

namespace App\Http\Livewire\Course;

use App\Models\Admin\Batch;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

// models
use App\Models\Admin\Course;
use App\Models\Admin\IntermediaryLevel;
use App\Models\Admin\Bundle;
use App\Models\User;

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
    public $teachers;
    public $teacherId;
    public $duration;
    public $url;
    public $image;
    public $banner;
    public $tempImage;
    public $tempBanner;
    public $deleteImage;
    public $deleteBanner;
    public $show_price;
    public $show_teachers;

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

   //  public function updatedBundleId()
   //  {
   //      if($this->bundleId){
   //          $this->show_price = false;
   //          $this->show_teachers = true;
   //      }
   //      else{
   //          $this->show_price = true;
   //          $this->show_teachers = false;
   //      }
   //      $this->validate([
   //         'bundleId' => 'nullable|numeric|integer'
   //      ]);
   //  }

    public function updatedTeacherId()
    {
       $this->validate([
            'teacherId' => 'required|numeric|integer'
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
        'title' => 'required|string|max:100',
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

    public function updateCourse()
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

        if ($this->tempImage) {
            $imageUrl = $this->image->store('public/course');
            $this->image = Storage::url($imageUrl);
            Storage::delete($this->deleteImage);
        }
        
        if ($this->tempBanner) {
            $imageUrl2 = $this->banner->store('public/course');
            $this->banner = Storage::url($imageUrl2);
            Storage::delete($this->deleteBanner);
        }

        $intermediary_level = IntermediaryLevel::where('id', $data['intermediaryLevelId'])->firstOrFail();

        $course = Course::find($this->course->id);
        $course->title = $data['title'];
        $course->slug = Str::slug($data['title']);
        $course->icon = $this->image;
        $course->banner = $this->banner;
        $course->course_category_id = $intermediary_level->course_category_id;
        $course->intermediary_level_id = $data['intermediaryLevelId'];
      //   if(empty($data['bundleId'])){
      //       $course->bundle_id = null;
      //   }
      //   else{
      //       $course->bundle_id = $data['bundleId'];
      //   }
        $course->description = $data['description'];
        $course->duration = $data['duration'];
        $course->trailer = $data['url'];
        if($this->bundleId){
           // set price to free
            $course->price = 0;
            // update batch teacher ID
            $batch = Batch::where('course_id', $course->id)->first();
            $batch->teacher_id = $this->teacherId;
            $batch->save();
        }
        else{
            $course->price = $data['price'];
        }

        $save = $course->save();

        if ($save) {
            session()->flash('status', 'Course successfully updated!');
            return redirect()->route('course.index');
        } else {
            session()->flash('failed', 'Course update failed!');
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

        $this->teachers = User::where('user_type', 2)->get();
        $batch = Batch::where('course_id', $this->course->id)->first();
        if($batch){
           $this->teacherId = $batch->teacher_id;
        }

        if($this->course->bundle_id !== null){
            $this->show_price = false;
            $this->show_teachers = true;
        }
        else{
            $this->show_price = true;
            $this->show_teachers = false;
        }

        $this->intermediary_levels = IntermediaryLevel::all();
        $this->bundles = Bundle::all();
        $this->teachers = User::where('user_type', 2)->get();
    }

    public function render()
    {
        return view('livewire.course.edit');
    }
}
