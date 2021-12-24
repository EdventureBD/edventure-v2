<?php

namespace App\Models\Admin;

use App\Models\Admin\Course;
use App\Models\Admin\CourseTopic;
use App\Models\Admin\CourseLecture;
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
}
