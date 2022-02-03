<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamCategory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function examTopics()
    {
        return $this->hasMany(ExamTopic::class);
    }

    public function modelExam()
    {
        return $this->hasOne(ModelExam::class);
    }
}
