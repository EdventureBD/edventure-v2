<?php

namespace App\Imports;

use App\Models\Admin\CQ;
use Illuminate\Support\Str;
use App\Models\Admin\Assignment;
use App\Models\Admin\CreativeQuestion;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Admin\QuestionContentTag;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CQQuestionImport implements ToModel, WithHeadingRow
{
    public $exam;

    public function __construct($exam)
    {
        $this->exam = $exam;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if ($this->exam->exam_type == 'CQ') {
            $creativeQuestion = CreativeQuestion::updateOrInsert(
                [
                    'slug' => $row['slug'],
                ],
                [
                    'creative_question' => trim($row['creative_question']),
                    'slug' => trim($row['slug']),
                    'image' => trim($row['image']),
                    'exam_id' => $this->exam->id,
                    'standard_ans_pdf' => "pdf",
                ]
            );
            $creativeQuestionId = CreativeQuestion::where('slug', $row['slug'],)->first();

            $content_tag_id = $row['content_tag_id'];
            if ($content_tag_id) {
                $content_tag_id = explode(",", $content_tag_id);
            }
            $slug = (string) Str::uuid();
            $check = CQ::where('slug', $slug)->first();
            if (!$check) {
                $cq = CQ::create([
                    'question' => trim($row['question']),
                    'slug' => $slug,
                    'image' => trim($row['image']),
                    'marks' => $row['marks'],
                    'creative_question_id' => $creativeQuestionId->id,
                    'number_of_attempt' => 0,
                    'gain_marks' => 0,
                    'success_rate' => 0,
                ]);
                $question_id = CQ::where('slug', $slug)->first();
                if ($content_tag_id) {
                    if (count($content_tag_id) > 0) {
                        for ($i = 0; $i < sizeOf($content_tag_id); $i++) {
                            $question_content_tag = new QuestionContentTag();
                            $question_content_tag->exam_type = 'CQ';
                            $question_content_tag->question_id = $question_id->id;
                            $question_content_tag->content_tag_id = intval($content_tag_id[$i]);
                            $question_content_tag->save();
                        }
                    }
                }
            }
        } else if ($this->exam->exam_type == 'Assignment') {
            $slug = Str::slug($row['question']);
            $check = Assignment::where('slug', $slug)->first();
            if (!$check) {
                return new Assignment([
                    'question' => trim($row['question']),
                    'slug' => $slug,
                    'image' => trim($row['image']),
                    'marks' => intval($row['marks']),
                    'exam_id' => $this->exam->id,
                ]);
            }
        }
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function uniqueBy()
    {
        return 'slug';
    }
}
