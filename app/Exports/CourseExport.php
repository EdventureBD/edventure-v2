<?php

namespace App\Exports;

use App\Models\Admin\Course;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;

class CourseExport implements FromCollection, Responsable, WithHeadings
{
    use Exportable;
    
    private $fileName = 'courses.xlsx';
    
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
            "Logo",
            "Trailer",
            "Course Category Id",
            "Description",
            "Price",
            "Duration",
            "Status",
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
        return Course::all()->except('created_at', 'updated_at');
    }
}
