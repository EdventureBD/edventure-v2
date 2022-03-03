<?php

namespace App\Models\Admin;

use App\Models\Admin\Course;
use App\Models\Admin\CourseTopic;
use App\Models\Admin\CourseLecture;
use App\Models\Admin\QuestionContentTag;
use App\Models\Student\exam\QuestionContentTagAnalysis;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContentTag extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function Lecture()
    {
        return $this->belongsTo(CourseLecture::class);
    }

    public function Topic()
    {
        return $this->belongsTo(CourseTopic::class);
    }

    public function questionContentTags()
    {
        return $this->hasMany(QuestionContentTag::class, 'content_tag_id');
    }

    public function questionContentTagAnalysis()
    {
        return $this->hasMany(QuestionContentTagAnalysis::class, 'content_tag_id');
    }
}
