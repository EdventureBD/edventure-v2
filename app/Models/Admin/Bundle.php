<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bundle extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function intermediary_level()
    {
        return $this->belongsTo(IntermediaryLevel::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'bundle_id', 'id');
    }
}
