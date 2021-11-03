<?php

namespace App\Models\Admin;

use App\Models\Admin\CQ;
use App\Models\Admin\MCQ;
use App\Models\Admin\ContentTag;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuestionContentTag extends Model
{
    use HasFactory;

    public function question()
    {
        return $this->belongsTo(MCQ::class, 'question_id', 'id');
    }

    public function cqQuestion()
    {
        return $this->belongsTo(CQ::class, 'question_id', 'id');
    }

    public function contentTag()
    {
        return $this->belongsTo(ContentTag::class, 'content_tag_id');
    }
}
