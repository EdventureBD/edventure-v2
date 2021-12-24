<?php

namespace App\Exports;

use Maatwebsite\Excel\Excel;
use App\Models\Admin\CourseLecture;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;

class CourseLectureExport implements FromCollection, Responsable, WithHeadings
{
    use Exportable;

    private $fileName = 'Course Lecures.xlsx';

    private $writerType = Excel::XLSX;

    private $headers = [
        'Content-Type' => 'text/csv',
    ];
    public function headings(): array
    {
        return [
            "Course Title",
            "Course Id",
            "Topic Title",
            "Topic Id",
            "Lecture Title",
            "Lecture Id",
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $allIds = CourseLecture::join('courses', 'course_lectures.course_id', 'courses.id')
            ->join('course_topics', 'course_lectures.topic_id', 'course_topics.id')
            ->select('courses.title as courseTitle', 'courses.id as courseId', 'course_topics.title as topicTitle', 'course_topics.id as topicId', 'course_lectures.title as lecturesTitle',  'course_lectures.id as lecturesId')
            ->get();
        return $allIds;
    }
}
