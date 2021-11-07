<?php

namespace App\Models\Admin;

use App\Models\Admin\Batch;
use App\Models\Admin\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class LiveClass extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    // public function course()
    // {
    //     return $this->belongsTo(Course::class, 'course_id');
    // }
}
