<?php

namespace App\Models;

use App\Models\Admin\StudentTopicEndExamAttempt;
use App\Models\Student\StudentDetails;
use Illuminate\Notifications\Notifiable;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{

    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'is_admin',
        'user_type',
        'image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function () {
            Cache::forget('usersList');
        });
    }

    public function studentDetails()
    {
        return $this->hasOne(StudentDetails::class, 'user_id', 'id');
    }

    public function teacherDetails()
    {
        return $this->hasOne(TeacherDetail::class, 'user_id', 'id');
    }

    public function student_topic_end_exam_attempts()
    {
        return $this->hasMany(StudentTopicEndExamAttempt::class, 'student_id');
    }
}
