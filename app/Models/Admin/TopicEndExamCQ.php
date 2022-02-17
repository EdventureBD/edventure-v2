<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Admin\TopicEndExamCreativeQuestion;
use App\Models\Admin\ContentTag;
use App\Models\Student\exam\DetailsResult;

class TopicEndExamCQ extends Model
{
    use HasFactory;

    protected $table = "topic_end_exam_cqs";

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $guarded = [];

    public function creativeQuestion()
    {
        return $this->belongsTo(TopicEndExamCreativeQuestion::class);
    }

    public function contentTag()
    {
        return $this->hasMany(ContentTag::class);
    }

    public function detailsResult()
    {
        return $this->hasOne(DetailsResult::class, 'question_id');
    }

    public function allDetailsResult()
    {
        return $this->hasMany(DetailsResult::class, 'question_id');
    }
}
