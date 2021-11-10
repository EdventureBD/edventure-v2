<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')
                ->references('id')->on('courses')
                ->onDelete('cascade');

            $table->unsignedBigInteger('batch_id');
            $table->foreign('batch_id')
                    ->references('id')->on('batches')
                    ->onDelete('cascade');

            $table->string('name');
            $table->string('email');
            $table->string('contact');
            $table->string('trx_id');
            $table->string('payment_type');
            $table->integer('amount');
            $table->bigInteger('payment_account_number');
            $table->integer('days_for');
            $table->boolean('accepted')->default(0);
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
        Schema::dropIfExists('payments');
    }
}
