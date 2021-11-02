<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $checkEmail = User::where('email', $row['email'])->first();
        $checkPhone = User::where('phone', $row['phone'])->first();
        if (!$checkEmail && !$checkPhone) {
            return new User([
                'name' => $row['name'],
                'email' => $row['email'],
                'phone' => $row['phone'],
                'is_admin' => intval($row['is_admin']),
                'user_type' => intval($row['user_type']),
                'password' => $row['password'],
            ]);
        }
    }
}
