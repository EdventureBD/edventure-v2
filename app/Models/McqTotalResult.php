<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McqTotalResult extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function modelExam()
    {
        return $this->belongsTo(ModelExam::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class,'student_id','id');
    }
}
