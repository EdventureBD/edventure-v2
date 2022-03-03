<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McqMarkingDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function mcqQuestion()
    {
        return $this->belongsTo(McqQuestion::class);
    }

    public function modelExam()
    {
        return $this->belongsTo(ModelExam::class);
    }
}
