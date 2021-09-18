<?php

namespace App\Imports\All;

use App\Models\Admin\ContentTag;
use App\Models\Admin\MCQ;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;

class MCQImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $slug = Str::slug($row['question']);
        $check = MCQ::where('slug', $slug)->first();
        if (!$check) {
            $mcq = new MCQ([
                'question' => $row['question'],
                'slug' => $slug,
                'image' => $row['image'],
                'field1' => $row['field1'],
                'field2' => $row['field2'],
                'field3' => $row['field3'],
                'field4' => $row['field4'],
                'answer' => $row['answer'],
                'exam_id' => $row['exam_id'],
                'number_of_attempt' => 0,
                'gain_marks' => 0,
                'success_rate' => 0
            ]);
            $contentTags = new ContentTag([
                '' => '',
            ]);
        }
    }
}
