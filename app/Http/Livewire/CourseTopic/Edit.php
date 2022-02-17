<?php

namespace App\Http\Livewire\CourseTopic;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

use App\Models\Admin\CourseCategory;
use App\Models\Admin\IntermediaryLevel;
use App\Models\Admin\Course;
use App\Models\Admin\CourseTopic;

class Edit extends Component
{
   use WithFileUploads;

   public $all_course_categories;
   public $courseCategory;
   public $courseCategoryId;
   public $all_intermediary_levels;
   public $intermediaryLevel;
   public $intermediaryLevelId;
   public $all_courses;
   public $course;
   public $courseId;
   public $course_topic;
   public $title;
   public $islandImage;

   public $show = false;

   protected $rules = [
      'title' => ['required', 'string', 'max:200', 'unique:course_topics,title'],
      'courseCategoryId' => ['required'],
      'intermediaryLevelId' => ['required'],
      'courseId' => ['required'],
      'islandImage' => ['file', 'image', 'max:5000'],
   ];

   public function updatedTitle(){
      $this->validate([
         'title' => ['required', 'string', 'max:200', 'unique:course_topics,title,'.$this->course_topic->id],
      ]);
   }

   public function updatedCourseCategoryId()
   {
      $this->all_intermediary_levels = IntermediaryLevel::where('course_category_id', $this->courseCategoryId)->get();
      $this->all_courses = collect();
   }

   public function updatedIntermediaryLevelId()
   {
      $this->all_courses = Course::where('intermediary_level_id', $this->intermediaryLevelId)->get();
   }

   public function updatedIslandImage()
   {
      $this->validate([
         'islandImage' => ['required', 'file', 'image', 'max:5000'],
      ]);
   }

   public function updateCourseTopic()
   {
      $data = $this->validate();
      $course_topic = CourseTopic::find($this->course_topic->id);
      $course_topic->title = $data['title'];
      if (!empty($this->islandImage)) {
         $course_topic->island_image = Storage::url($this->islandImage->store('public/roadmap/island_images'));
      }
      $course_topic->course_id = $data['courseId'];
      $course_topic->intermediary_level_id = $data['intermediaryLevelId'];
      $course_topic->slug = (string) Str::uuid();
      $course_topic->order = 0;
      $course_topic->status = 1;
      $save = $course_topic->save();

      if ($save) {
         session()->flash('status', 'Course successfully updated!');
         return redirect()->route('course-topic.index');
      } else {
         session()->flash('failed', 'Course updated failed!');
         return redirect()->route('course-topic.edit', $this->course_topic->slug);
      }
   }

   public function mount()
   {
      $this->title = $this->course_topic->title;
      $this->all_course_categories = CourseCategory::all();

      $this->courseId = $this->course_topic->course_id;
      $this->course = Course::where('id', $this->courseId)->firstOrFail();
      $this->intermediaryLevelId = $this->course_topic->intermediary_level_id;
      $this->intermediaryLevel = IntermediaryLevel::where('id', $this->intermediaryLevelId)->firstOrFail();
      $this->courseCategoryId = $this->intermediaryLevel->course_category_id;
      $this->courseCategory = CourseCategory::where('id', $this->courseCategoryId)->firstOrFail();
      $this->all_intermediary_levels = IntermediaryLevel::where('course_category_id', $this->courseCategoryId)->get();
      $this->all_courses = Course::where('intermediary_level_id', $this->intermediaryLevelId)->get();

   }

   public function render()
   {
      return view('livewire.course-topic.edit');
   }
}
