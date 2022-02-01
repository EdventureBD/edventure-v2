<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamTag extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function examTopic()
    {
        return $this->belongsTo(ExamTopic::class);
    }
}
