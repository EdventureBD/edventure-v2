<?php

namespace App\Exports;

use App\Models\Admin\Exam;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExamExport implements FromCollection, WithHeadings, Responsable
{
    use Exportable;

    private $fileName = 'All Exams.xlsx';

    private $writerType = Excel::XLSX;

    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    public function headings(): array
    {
        return [
            "Id",
            "Title",
            "Slug",
            "Course Id",
            "Topic Id",
            "Exam Type",
            "Special",
            "Marks",
            "Duration",
            "Question Limit",
            "Order",
            "Created At",
            "Updated At",
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Exam::all();
    }
}
