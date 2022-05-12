<?php

namespace App\Models;

use App\Models\Admin\Bundle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BundlePayment extends Model
{
    use HasFactory;

    public function bundle()
    {
        return $this->belongsTo(Bundle::class);
    }
}
