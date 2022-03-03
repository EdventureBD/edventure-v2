<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentOfExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_of_exams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('model_exam_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('single_payment_id');
            $table->foreign('model_exam_id')->references('id')->on('model_exams')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('single_payment_id')->references('id')->on('single_payments')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_of_exams');
    }
}
