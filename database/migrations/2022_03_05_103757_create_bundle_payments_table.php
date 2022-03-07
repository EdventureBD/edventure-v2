<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBundlePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bundle_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('bundle_id');
            $table->string('name');
            $table->string('email');
            $table->string('contact');
            $table->string('trx_id');
            $table->string('payment_type');
            $table->unsignedInteger('amount');
            $table->string('payment_account_number');
            $table->unsignedInteger('days_for');
            $table->tinyInteger('accepted');
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
        Schema::dropIfExists('bundle_payments');
    }
}
