<?php

namespace App\Models\Admin;

use App\Models\Admin\Course;
use App\Models\Admin\BatchExam;
use App\Models\Admin\CourseTopic;
use App\Models\Admin\CourseLecture;
use App\Models\Student\exam\ExamResult;
use App\Models\Student\exam\DetailsResult;
use App\Models\Admin\StudentTopicEndExamAttempt;
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

    public function course_lectures()
    {
        return $this->hasMany(CourseLecture::class, 'exam_id');
    }

    public function details_results()
    {
        return $this->hasMany(DetailsResult::class, 'exam_id');
    }

    public function exam_results()
    {
        return $this->hasMany(ExamResult::class, 'exam_id');
    }

    public function exam_attempts()
    {
        return $this->hasMany(StudentTopicEndExamAttempt::class, 'topic_end_exam_id');
    }
}
