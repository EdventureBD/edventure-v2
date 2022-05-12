<?php

namespace App\Http\Livewire\CourseTopic;

use App\Models\Admin\Batch;
use App\Models\Admin\BatchLecture;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

use App\Models\Admin\Course;
use App\Models\Admin\CourseTopic;
use App\Models\Admin\CourseCategory;
use App\Models\Admin\IntermediaryLevel;

class Create extends Component
{
   use WithFileUploads;

   public $categories;
   public $categoryId;
   public $intermediaryLevels;
   public $intermediaryLevelId;
   public $title;
   public $courseId;
   public $zeroStarIslandImage;
   public $oneStarIslandImage;
   public $twoStarIslandImage;
   public $threeStarIslandImage;
   public $disabledIslandImage;

   public $show = false;

   protected $rules = [
      'title' => ['required', 'string', 'max:200', 'unique:course_topics,title'],
      'categoryId' => ['required'],
      'intermediaryLevelId' => ['required'],
      'courseId' => ['required'],
      'zeroStarIslandImage' => ['required', 'file', 'image', 'max:5000'],
      'oneStarIslandImage' => ['required', 'file', 'image', 'max:5000'],
      'twoStarIslandImage' => ['required', 'file', 'image', 'max:5000'],
      'threeStarIslandImage' => ['required', 'file', 'image', 'max:5000'],
      'disabledIslandImage' => ['required', 'file', 'image', 'max:5000'],
   ];

   public function updatedTitle(){
      $this->validate([
         'title' => ['required', 'string', 'max:200', 'unique:course_topics,title'],
      ]);
   }

   public function updatedCategoryId()
   {
      $this->intermediaryLevels = IntermediaryLevel::where('course_category_id', $this->categoryId)->get();
      $this->courses = collect();
   }

   public function updatedIntermediaryLevelId()
   {
      $this->courses = Course::where('intermediary_level_id', $this->intermediaryLevelId)->get();
   }

   public function updatedZeroStarIslandImage()
   {
      $this->validate([
         'zeroStarIslandImage' => ['required', 'file', 'image', 'max:5000'],
      ]);
   }

   public function updatedOneStarIslandImage()
   {
      $this->validate([
         'oneStarIslandImage' => ['required', 'file', 'image', 'max:5000'],
      ]);
   }

   public function updatedTwoStarIslandImage()
   {
      $this->validate([
         'twoStarIslandImage' => ['required', 'file', 'image', 'max:5000'],
      ]);
   }

   public function updatedThreeStarIslandImage()
   {
      $this->validate([
         'threeStarIslandImage' => ['required', 'file', 'image', 'max:5000'],
      ]);
   }

   public function updatedDisabledIslandImage()
   {
      $this->validate([
         'disabledIslandImage' => ['required', 'file', 'image', 'max:5000'],
      ]);
   }

   public function saveCourseTopic()
   {
      $data = $this->validate();
      $course_topic = new CourseTopic;
      $course_topic->title = $data['title'];
      $course_topic->slug = (string) Str::uuid();
      if (!empty($this->zeroStarIslandImage)) {
         $course_topic->zero_star_island_image = Storage::url($this->zeroStarIslandImage->store('public/roadmap/island_images'));
      }
      if (!empty($this->oneStarIslandImage)) {
         $course_topic->one_star_island_image = Storage::url($this->oneStarIslandImage->store('public/roadmap/island_images'));
      }
      if (!empty($this->twoStarIslandImage)) {
         $course_topic->two_star_island_image = Storage::url($this->twoStarIslandImage->store('public/roadmap/island_images'));
      }
      if (!empty($this->threeStarIslandImage)) {
         $course_topic->three_star_island_image = Storage::url($this->threeStarIslandImage->store('public/roadmap/island_images'));
      }
      if (!empty($this->disabledIslandImage)) {
         $course_topic->disabled_island_image = Storage::url($this->disabledIslandImage->store('public/roadmap/island_images'));
      }
      $course_topic->intermediary_level_id = $data['intermediaryLevelId'];
      $course_topic->course_id = $data['courseId'];
      $course_topic->order = 0;
      $course_topic->status = 1;
      $url = url()->previous();
      $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();

      $slug = Course::where('id', $this->courseId)
         ->select('courses.slug')
         ->first();

      $save = $course_topic->save();

      if ($save) {
         $course = Course::where('id', $data['courseId'])->first();
         if($course->bundle_id){
            $batch = Batch::where('course_id', $course->id)->first();
            $batchLecture = new BatchLecture();
            $batchLecture->batch_id = $batch->id;
            $batchLecture->course_id = $course->id;
            $batchLecture->topic_id = $course_topic->id;
            $batchLecture->status = 1;
            $batchLecture->save();
         }

         session()->flash('status', 'Island created successfully!');
         if ($route == "course.show") {
            return redirect()->route('course.show', $slug);
         }
         else {
            return redirect()->route('course-topic.index');
         }
      } else {
         session()->flash('failed', 'Island created failed!');
         return redirect()->route('course-topic.create');
      }
   }

   public function mount()
   {
      $this->categories = CourseCategory::all();
      $this->intermediaryLevels = collect();
      $this->courses = collect();
   }

   public function render()
   {
      return view('livewire.course-topic.create');
   }
}
