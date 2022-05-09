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

    protected $casts = [
        'teachers' => 'array',
    ];

    protected $appends = [
        'teacher_lists'
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->uuid = uuid();
            $query->price = $query->price ?? 0;
            $query->time_allotted = $query->time_allotted ?? 0;
            $query->full_solutions = $query->full_solutions ?? 0;
            $query->paper_final = $query->paper_final ?? 0;
            $query->subject_final = $query->subject_final ?? 0;
            $query->final_exam = $query->final_exam ?? 0;
            $query->offer_price = $query->offer_price ?? 0;
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

    public function totalParticipation()
    {
        return $this->hasManyThrough(McqTotalResult::class, ModelExam::class);
    }
    public function paymentOfCategories()
    {
        return $this->hasMany(PaymentOfCategory::class,'exam_category_id','id');
    }

    public function getTeacherListsAttribute()
    {
        $ids = !empty($this->attributes['teachers']) ? json_decode($this->attributes['teachers']) : null;
        $teachers = null;

        if($ids) {
            $userId = array_values($ids);
            $teachers = User::query()->whereIn('id',$userId)->get();
        }

        return $teachers;
    }
}
