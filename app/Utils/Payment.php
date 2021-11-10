<?php
namespace App\Utils;

use App\Models\Admin\Course;
use smasif\ShurjopayLaravelPackage\ShurjopayService;

class Payment {

    public function processPayment($amount, $success_url, $data=[])
    {
        //Initiate the object
        $shurjopay_service = new ShurjopayService(); 
        // Get transaction id. You can use custom id like: $shurjopay_service->generateTxId('123456');
        $tx_id = $shurjopay_service->generateTxId(); 
        // $payment = 
        $shurjopay_service->sendPayment($amount, $success_url, $data); 
    }

    public function paymentSuccess(Course $course)
    {
        $data = ["course"=>$course, 'requests'=>request()->all()];
        dd($data);
    }
}