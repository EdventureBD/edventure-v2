<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property
 */
class ExamTopic extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function examCategory()
    {
        return $this->belongsTo(ExamCategory::class);
    }
}
