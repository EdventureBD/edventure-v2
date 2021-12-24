<?php

namespace App\Models\Admin;

use App\Models\Admin\Course;
use App\Models\Admin\CourseTopic;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseLecture extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function Course()
    {
        return $this->belongsTo(Course::class);
    }

    public function Topic()
    {
        return $this->belongsTo(CourseTopic::class);
    }
}
