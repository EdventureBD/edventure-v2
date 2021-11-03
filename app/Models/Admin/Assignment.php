<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Assignment extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $guarded = [];
}
