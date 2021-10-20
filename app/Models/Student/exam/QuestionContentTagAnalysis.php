<?php

namespace App\Models\Student\exam;

use App\Models\User;
use App\Models\Admin\Exam;
use App\Models\Admin\Batch;
use App\Models\Admin\ContentTag;
use App\Models\Admin\CQ;
use App\Models\Admin\QuestionContentTag;
use App\Models\AppModel;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuestionContentTagAnalysis extends AppModel
{
    use HasFactory, LogsActivity;
    protected $fillable = ['content_tag_id', 'student_id', 'exam_type', 'question_id', 'number_of_attempt', 'gain_marks', 'status'];
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

    public function saveQuesConTagAnalysis($input)
    {
        if (empty($input['question_id'])) return;
        $tags = (new QuestionContentTag())->where('question_id', $input['question_id'])->get();
        if ($tags->count()) {
            foreach($tags as $tag) {
                $tagAnalaysis = new QuestionContentTagAnalysis();
                $input['content_tag_id'] = $tag->content_tag_id;
                $input['number_of_attempt'] = 1;
                $tagAnalaysis->saveData($input);
            }
        }
    }
}
