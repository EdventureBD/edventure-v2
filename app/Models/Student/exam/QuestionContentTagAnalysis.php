<?php

namespace App\Models\Student\exam;

use App\Models\User;
use App\Models\Admin\Exam;
use App\Models\Admin\Batch;
use App\Models\Admin\ContentTag;
use App\Models\Admin\CQ;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuestionContentTagAnalysis extends Model
{
    use HasFactory, LogsActivity;
    protected static $logName = "Question content tag analysis";
    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName}";
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contentTag()
    {
        return $this->belongsTo(ContentTag::class, 'content_tag_id');
    }

    public function cqQuestion()
    {
        return $this->belongsTo(CQ::class, 'question_id');
    }
}
