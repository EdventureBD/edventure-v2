<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchStudentEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_student_enrollments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('batch_id');
            $table->foreign('batch_id')->references('id')->on('batches')->onDelete('cascade');

            $table->unsignedBigInteger('payment_id');
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');

            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');

            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('note_list')->nullable();
            $table->integer('individual_batch_days');
            $table->integer('accessed_days');
            $table->boolean('status');
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
        Schema::dropIfExists('batch_student_enrollments');
    }
}
