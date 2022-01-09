<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\TopicEndExamCreativeQuestion;
use App\Models\Admin\ContentTag;

class TopicEndExamCQ extends Model
{
    use HasFactory;

    protected $table = "topic_end_exam_cqs";

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $guarded = [];

    public function TopicEndExamCreativeQuestion()
    {
        return $this->belongsTo(TopicEndExamCreativeQuestion::class);
    }

    public function contentTag()
    {
        return $this->hasMany(ContentTag::class);
    }
}
