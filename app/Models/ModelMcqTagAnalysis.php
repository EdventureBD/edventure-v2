<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelMcqTagAnalysis extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'model_mcq_tag_analysis';
}
