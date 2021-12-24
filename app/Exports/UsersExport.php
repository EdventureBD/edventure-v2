<?php

namespace App\Exports;

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

class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize, WithColumnFormatting, WithMapping
{
    use Exportable;

    private $fileName = 'Users.xlsx';

    private $writerType = Excel::XLSX;

    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    public function headings(): array
    {
        return [
            "Name",
            "Email",
            "Phone Number",
            "User Type",
            "Registerd On",
        ];
    }

    public function map($user): array
    {
        if ($user->user_type == 1) {
            $userType = "Admin";
        } else if ($user->user_type == 2) {
            $userType = "Teacher";
        } else if ($user->user_type == 3) {
            $userType = "Student";
        }

        if (strlen($user->phone) == 10) {
            $user->phone = "0" . $user->phone;
        }

        return [
            $user->name,
            $user->email,
            $user->phone,
            $userType,
            Date::dateTimeToExcel($user->created_at),
        ];
    }

    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_DATE_DDMMYYYY . " at " . NumberFormat::FORMAT_DATE_TIME2,
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::select('name', 'email', 'phone', 'user_type', 'created_at')->get();
    }
}
