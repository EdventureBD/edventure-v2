<?php

namespace App\Models\Admin;

use App\Models\Admin\CourseTopic;
use App\Models\Admin\BatchLecture;
use App\Models\Admin\CourseLecture;
use App\Models\Admin\IntermediaryLevel;
use App\Models\Admin\Bundle;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

use App\Models\Admin\BatchStudentEnrollment;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $appends = [
        'teacher_lists'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function intermediaryLevel()
    {
        return $this->belongsTo(IntermediaryLevel::class, 'intermediary_level_id', 'id');
    }

    public function bundle()
    {
        return $this->belongsTo(Bundle::class);
    }

    public function Exam()
    {
        return $this->hasMany(Exam::class);
    }

    public function Batch()
    {
        return $this->hasMany(Batch::class);
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
        $courses = !empty($category_ids) ? $this->whereIn('course_category_id', $category_ids)->where('status', 1) : $this->where('status', 1);
        if (!empty($excluded_courses)) $courses = $courses->whereNotIn('id', $excluded_courses);
        if ($random) return $courses->inRandomOrder()->take(2)->get();
        else return $courses->get();
    }

    public function getTeacherListsAttribute()
    {
        $teachers = null;
        if($this->Batch()->count() > 0) {
            foreach ($this->Batch()->get() as $batch) {
                $ids[] = $batch->teacher_id;
            }
            $userId = array_values($ids);
            $teachers = User::query()->whereIn('id',$userId)->with('teacherDetails')->get();
        }

        return $teachers;
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function totalCourseEnrolled()
    {
        return $this->payment()->count();
    }
}
