<?php

namespace App\Models\Student\exam;

use App\Models\User;
use App\Models\Admin\Exam;
use App\Models\Admin\Batch;
use App\Models\Admin\ContentTag;
use App\Models\Admin\CQ;
use App\Models\Admin\QuestionContentTag;
use App\Models\AppModel;
use App\Utils\Edvanture;
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
        $tags = (new QuestionContentTag())->where('exam_type', $input['exam_type'])->where('question_id', $input['question_id'])->get();
        if ($tags->count()) {
            foreach ($tags as $tag) {
                $tagAnalaysis = new QuestionContentTagAnalysis();
                $input['content_tag_id'] = $tag->content_tag_id;
                $input['number_of_attempt'] = 1;
                $tagAnalaysis->saveData($input);
            }
        }
    }

    public function getTagAnalysisReport($student_id, $batch_id = null, $course_id = null)
    {
        if (empty($course_id)) {
            $batch = (new Batch())->getById($batch_id);
            $course_id = $batch->course_id;
        }
        $analysis = $this->with('contentTag')->with('cqQuestion')->where('student_id', $student_id)->get();

        $gain_marks = [];
        $total_marks = [];
        $mcq_tag_details = [];
        $cq_tag_details = [];
        foreach ($analysis as $analyst) {
            if ($analyst->contentTag->course_id == $course_id) {
                if ($analyst->exam_type == Edvanture::MCQ) {
                    if (!isset($gain_marks[$analyst->contentTag->title])) $gain_marks[$analyst->contentTag->title] = [];
                    if (!isset($total_marks[$analyst->contentTag->title])) $total_marks[$analyst->contentTag->title] = [];
                    if (!isset($gain_marks[$analyst->contentTag->title][Edvanture::MCQ])) $gain_marks[$analyst->contentTag->title][Edvanture::MCQ] = 0;
                    if (!isset($total_marks[$analyst->contentTag->title][Edvanture::MCQ])) $total_marks[$analyst->contentTag->title][Edvanture::MCQ] = 0;
                    $gain_marks[$analyst->contentTag->title][Edvanture::MCQ] += $analyst->gain_marks;
                    $total_marks[$analyst->contentTag->title][Edvanture::MCQ] += 1;

                    if (!isset($mcq_tag_details[$analyst->contentTag->title])) $mcq_tag_details[$analyst->contentTag->title] = [];
                    $mcq_tag_details[$analyst->contentTag->title]['topic_id'] = $analyst->contentTag->topic_id;
                } else if (($analyst->exam_type == Edvanture::CQ)) {
                    if (!isset($gain_marks[$analyst->contentTag->title])) $gain_marks[$analyst->contentTag->title] = [];
                    if (!isset($total_marks[$analyst->contentTag->title])) $total_marks[$analyst->contentTag->title] = [];
                    if (!isset($gain_marks[$analyst->contentTag->title][Edvanture::CQ])) $gain_marks[$analyst->contentTag->title][Edvanture::CQ] = 0;
                    if (!isset($total_marks[$analyst->contentTag->title][Edvanture::CQ])) $total_marks[$analyst->contentTag->title][Edvanture::CQ] = 0;
                    $gain_marks[$analyst->contentTag->title][Edvanture::CQ] += $analyst->gain_marks;
                    $total_marks[$analyst->contentTag->title][Edvanture::CQ] += $analyst->cqQuestion->marks;

                    if (!isset($cq_tag_details[$analyst->contentTag->title])) $cq_tag_details[$analyst->contentTag->title] = [];
                    $cq_tag_details[$analyst->contentTag->title]['topic_id'] = $analyst->contentTag->topic_id;
                }
            }
        }

        $mcq_strength = [];
        $cq_strength = [];
        $mcq_weakness = [];
        $cq_weakness = [];

        foreach ($gain_marks as $tag => $value) {
            $mcq = !empty($value[Edvanture::MCQ]) ? round(($value[Edvanture::MCQ] * 100) / $total_marks[$tag][Edvanture::MCQ]) : 0;
            $cq = !empty($value[Edvanture::CQ]) ? round(($value[Edvanture::CQ] * 100) / $total_marks[$tag][Edvanture::CQ]) : 0;
            if ($mcq >= 80) array_push($mcq_strength, $tag);
            else array_push($mcq_weakness, $tag);

            if ($cq >= 80) array_push($cq_strength, $tag);
            else array_push($cq_weakness, $tag);
            $mcq_tag_details[$tag]['score'] = $mcq;
            $cq_tag_details[$tag]['score'] = $cq;
        }
        return [
            'mcq' => ['weakness' => $mcq_weakness, 'strength' => $mcq_strength],
            'cq' => ['weakness' => $cq_weakness, 'strength' => $cq_strength],
            'mcq_tag_details' => $mcq_tag_details,
            'cq_tag_details' => $cq_tag_details,
        ];
    }
}
