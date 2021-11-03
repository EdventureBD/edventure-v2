<?php

namespace App\Models\Admin;

use App\Models\Admin\Batch;
use App\Models\Admin\Course;
use App\Models\Admin\CourseTopic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BatchLecture extends Model
{
    use HasFactory;

    public function course()
    {
        $this->belongsTo(Course::class);
    }

    public function topic()
    {
        $this->belongsTo(CourseTopic::class);
    }

    public function batch()
    {
        $this->belongsTo(Batch::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'teacher_id');
    }

    public function courseTopic()
    {
        return $this->belongsTo(CourseTopic::class, 'topic_id');
    }
}
