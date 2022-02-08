<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMcqTotalResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mcq_total_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('model_exam_id');
            $table->unsignedBigInteger('student_id');
            $table->integer('exam_end_time')->comment('Exam end remaining time will be store in seconds');
            $table->integer('duration')->comment('Exam duration will be store in seconds');
            $table->float('total_marks');
            $table->foreign('model_exam_id')->references('id')->on('model_exams')->onDelete('cascade');
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
        Schema::dropIfExists('mcq_total_results');
    }
}
