<?php

namespace App\Models\Admin;

use App\Models\AppModel;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends AppModel
{
    use HasFactory;
    const FREE = "FREE";
    const SHURJO_PAY = "SHURJO_PAY";

    protected $fillable = ["student_id", "course_id", "batch_id", "name", "email", "contact", "trx_id", "payment_type", "amount", "payment_account_number", "days_for", "accepted"];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function savePayment($student, $course, $opt=[])
    {
        $data = ["student_id" => $student->id,
                "course_id" => $course->id,
                "batch_id"=>!empty($opt['batch_id']) ? $opt['batch_id'] : null,
                "name" => $student->name,
                "email" => $student->email,
                "contact" => $student->phone,
                "trx_id" =>  !empty($opt['trx']) ? $opt['trx'] : self::FREE,
                "payment_type" =>  !empty($opt['payment_type']) ? $opt['payment_type'] : self::FREE,
                "amount" =>  !empty($opt['price']) ? $opt['price'] : 0,
                "payment_account_number" => !empty($opt['bank_trx']) ? $opt['bank_trx'] : "000",
                "days_for" => !empty($opt['days']) ? $opt['days'] : 365,
                "accepted" => !empty($opt['accepted']) ? $opt['accepted'] : 0
            ];
            // dd($data);
        $payment = $this->saveData($data); 
        return $payment;
    }

    public function getByTrxCourse($trx_id, $course_id)
    {
        return $this->where(['student_id'=>auth()->user()->id,'trx_id'=>$trx_id, 'course_id'=>$course_id, "accepted"=>0])->first();
    }
}
