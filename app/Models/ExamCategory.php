<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Integer;

class ExamCategory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->price = $query->price ?? 0;
        });
    }

    public function examTopics()
    {
        return $this->hasMany(ExamTopic::class);
    }

    public function modelExam()
    {
        return $this->hasOne(ModelExam::class);
    }

    public function paymentOfCategories()
    {
        return $this->hasMany(PaymentOfCategory::class,'exam_category_id','id');
    }
}
