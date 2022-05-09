<?php

namespace App\Exports;

use App\Models\McqTotalResult;
use App\Models\User;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class ModelExamResultExport implements FromCollection, WithHeadings, ShouldAutoSize, WithColumnFormatting, WithMapping
{
    use Exportable;

    private $fileName = 'Results.xlsx';

    private $writerType = Excel::XLSX;

    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    public function headings(): array
    {
        return [
            "Model exam",
            "Student",
            "Time Taken",
            "Total Marks",
            "Exam Time",
        ];
    }

    public function map($row): array
    {

        return [
            $row->modelExam->title,
            $row->student->name,
            gmdate("H:i:s", ($row->duration - $row->exam_end_time)),
            $row->total_marks,
            date('F j, Y, g:i a', strtotime($row->created_at)),

        ];
    }

    public function columnFormats(): array
    {
        return [];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return McqTotalResult::query()->with('modelExam')->with('student')->get();
    }
}
