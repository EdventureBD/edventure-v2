<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseCategory extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function course()
    {
        return $this->hasMany(Course::class);
    }
}
