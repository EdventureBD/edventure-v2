<?php

namespace App\Models\Admin;

use App\Models\Admin\CQ;
use App\Models\Admin\Exam;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class CreativeQuestion extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function question()
    {
        return $this->hasMany(CQ::class, 'creative_question_id');
    }
}
