<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMcqMarkingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mcq_marking_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('model_exam_id');
            $table->unsignedBigInteger('mcq_question_id');
            $table->unsignedBigInteger('student_id');
            $table->integer('mcq_ans');
            $table->float('gain_marks');
            $table->foreign('model_exam_id')->references('id')->on('model_exams')->onDelete('cascade');
            $table->foreign('mcq_question_id')->references('id')->on('mcq_questions')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('mcq_marking_details');
    }
}
