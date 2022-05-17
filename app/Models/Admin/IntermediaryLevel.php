<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntermediaryLevel extends Model
{
    use HasFactory;

    protected $fillable = ['course_category_id', 'title', 'slug', 'status'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function course()
    {
        return $this->hasMany(Course::class);
    }

    public function bundles()
    {
        return $this->hasMany(Bundle::class);
    }

    public function courseCategory()
    {
        return $this->belongsTo(CourseCategory::class);
    }
}
