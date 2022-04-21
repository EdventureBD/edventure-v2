<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
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
        static::created(function () {
            Cache::forget('categoriesList');
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
