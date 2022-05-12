<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class StudentTopicEndExamAttempt extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }
}
