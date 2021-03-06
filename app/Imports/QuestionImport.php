<?php

namespace App\Imports;

use App\Models\Admin\MCQ;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Admin\QuestionContentTag;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionImport implements ToModel, WithHeadingRow
{
    public $exam;

    public function __construct($exam)
    {
        $this->exam = $exam;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\rowbase\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // dd($row);
        $content_tag_id = $row['content_tag_id'];
        if ($content_tag_id) {
            $content_tag_id = explode(",", $content_tag_id);
        }
        $slug = (string) Str::uuid();
        $check = MCQ::where('slug', $slug)->first();
        if (!$check) {
            $mcq = MCQ::create([
                'question' => trim($row['question']),
                'slug' => $slug,
                'image' => trim($row['image']),
                'field1' => trim($row['field1']),
                'field2' => trim($row['field2']),
                'field3' => trim($row['field3']),
                'field4' => trim($row['field4']),
                'answer' => intval($row['answer']),
                'explanation' => $row['explanation'],
                'exam_id' => $this->exam->id,
                'number_of_attempt' => 0,
                'gain_marks' => 0,
                'success_rate' => 0
            ]);
            $question_id = MCQ::where('slug', $slug)->first();
            if ($content_tag_id) {
                if (count($content_tag_id) > 0) {
                    for ($i = 0; $i < sizeOf($content_tag_id); $i++) {
                        $question_content_tag = new QuestionContentTag();
                        $question_content_tag->exam_type = 'MCQ';
                        $question_content_tag->question_id = $question_id->id;
                        $question_content_tag->content_tag_id = $content_tag_id[$i];
                        $question_content_tag->save();
                    }
                }
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
