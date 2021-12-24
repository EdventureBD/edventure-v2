<?php

namespace App\Exports;

use Maatwebsite\Excel\Excel;
use App\Models\Admin\ContentTag;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;

class ContentTagExport implements FromCollection, Responsable, WithHeadings
{
    use Exportable;

    private $fileName = 'All content Tags.xlsx';

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
            "Lecture Id",
            "Status",
            "Created At",
            "Updated At",
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ContentTag::all();
    }
}
