<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property integer $exam_category_id
 */
class ExamTopic extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function examCategory()
    {
        return $this->belongsTo(ExamCategory::class);
    }

    public function examTags()
    {
        return $this->hasMany(ExamTag::class);
    }

    public function modelExam()
    {
        return $this->hasOne(ModelExam::class);
    }
}
