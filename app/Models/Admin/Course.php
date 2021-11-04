<?php

namespace App\Models\Admin;

use App\Models\Admin\CourseTopic;
use App\Models\Admin\BatchLecture;
use App\Models\Admin\CourseLecture;
use App\Models\Admin\CourseCategory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Admin\BatchStudentEnrollment;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function courseCategory()
    {
        return $this->belongsTo(CourseCategory::class);
    }

    public function CourseTopic()
    {
        return $this->hasMany(CourseTopic::class);
    }

    public function CourseLecture()
    {
        return $this->hasMany(CourseLecture::class);
    }

    public function batchLecture()
    {
        return $this->hasMany(BatchLecture::class);
    }

    public function liveClass()
    {
        return $this->hasMany(LiveClass::class);
    }

    public function student()
    {
        return $this->hasMany(BatchStudentEnrollment::class, 'course_id');
    }

    public function getRelatedCourses($category_ids = null, $excluded_courses = null, $random = false)
    {
        $courses = !empty($category_ids) ? $this->whereIn('course_category_id', $category_ids) : $this;
        if (!empty($excluded_courses)) $courses = $courses->whereNotIn('id', $excluded_courses);
        if ($random) return $courses->inRandomOrder()->take(2)->get();
        else return $courses->get();
    }
}
