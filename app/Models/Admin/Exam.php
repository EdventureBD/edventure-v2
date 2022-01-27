<?php

namespace App\Models\Admin;

use App\Models\Admin\Course;
use App\Models\Admin\BatchExam;
use App\Models\Admin\CourseTopic;
use App\Models\Admin\CourseLecture;

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

    public function popQuizCreativeQuestions()
    {
        return $this->hasMany(PopQuizCreativeQuestion::class);
    }

    public function topicEndExamCreativeQuestions()
    {
        return $this->hasMany(TopicEndExamCreativeQuestion::class);
    }

    public function course_lecture()
    {
        return $this->hasMany(CourseLecture::class, 'exam_id');
    }
}
