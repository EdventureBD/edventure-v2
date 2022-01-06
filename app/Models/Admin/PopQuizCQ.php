<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Admin\PopQuizCreativeQuestion;
use App\Models\Admin\ContentTag;

class PopQuizCQ extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $guarded = [];

    public function PopQuizCreativeQuestion()
    {
        return $this->belongsTo(PopQuizCreativeQuestion::class);
    }

    public function contentTag()
    {
        return $this->hasMany(ContentTag::class);
    }
}
