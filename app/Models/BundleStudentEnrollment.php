<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Admin\Bundle;

class BundleStudentEnrollment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bundle()
    {
        return $this->belongsTo(Bundle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(User::class);
    }
}
