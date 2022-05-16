<?php

namespace App\Models\Admin;

use App\Models\BundlePayment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bundle extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function intermediary_level()
    {
        return $this->belongsTo(IntermediaryLevel::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'bundle_id', 'id');
    }

    public function bundlePayments()
    {
        return $this->hasMany(BundlePayment::class);
    }

    public function totalBundleEnrolled()
    {
        $count  = $this->bundlePayments()->count();
        return $count < 59 ?  59 : $count;
    }

    public function teachersList()
    {
        $courses = $this->courses()->with('batch')->get();
        $teachers = null;

        if(count($courses) > 0) {
            foreach ($courses as $course) {
                $ids[] = $course->batch[0]->teacher_id;
            }
            $userId = array_values($ids);
            $teachers = User::query()->whereIn('id',$userId)->with('teacherDetails')->get();
        }

        return $teachers;

    }
}
