<?php

namespace App\Models\Admin;

use App\Models\User;
use App\Models\Admin\Exam;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentExamAttempt extends Model
{
    use HasFactory;

    public function student()
    {
        return $this->belongsTo(User::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function saveData()
    {
    }
}
