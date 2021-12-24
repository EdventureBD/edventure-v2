<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ExamType extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
