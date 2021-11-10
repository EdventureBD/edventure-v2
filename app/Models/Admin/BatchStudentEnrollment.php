<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BatchStudentEnrollment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(User::class);
    }

    public function getEnrollment($course_id, $student_id)
    {
        return $this->where(['course_id' => $course_id, 'student_id' => $student_id,
        ])->first();
    }
}
