<?php

namespace App\Imports;

use Illuminate\Support\Str;
use App\Models\Admin\ContentTag;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ContentTagImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $slug = (string) Str::uuid();;
        $check = ContentTag::where('slug', $slug)->first();
        if (!$check) {
            return new ContentTag([
                'title' => $row['title'],
                'slug' => $slug,
                'course_id' => $row['course_id'],
                'topic_id' => $row['topic_id'],
                'lecture_id' => $row['lecture_id'],
                'status' => 1,
            ]);
        }
    }
}
