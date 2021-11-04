<?php

namespace App\Models\Admin;

use App\Models\Admin\Course;
use App\Models\Admin\BatchExam;
use App\Models\Admin\CourseTopic;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exam extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function batchExam()
    {
        return $this->hasMany(BatchExam::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function topic()
    {
        return $this->belongsTo(CourseTopic::class);
    }
}
