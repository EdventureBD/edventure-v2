<?php

namespace App\Exports;

use Illuminate\Support\Str;
use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\{
    FromView,
    Exportable,
    WithHeadings,
    ShouldAutoSize
};
use Illuminate\Contracts\Support\Responsable;

class SlugExport implements FromView, Responsable, WithHeadings, ShouldAutoSize
{
    use Exportable;

    private $fileName = 'Slug.xlsx';

    private $writerType = Excel::XLSX;

    protected $slug;

    public function __construct($slug)
    {
        $this->slug = $slug;
    }

    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    public function headings(): array
    {
        return [
            "Slug"
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */

    public function view(): View
    {
        $slugs = [];
        for ($i = 0; $i < $this->slug; $i++) {
            $slug = (string) Str::uuid();
            $slugs[] = $slug;
        }
        return view('admin.pages.exports.slug', [
            'slugs' => $slugs
        ]);
    }
}
