<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelMcqTagAnalysisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_mcq_tag_analysis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('model_exam_id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('exam_tag_id');
            $table->unsignedBigInteger('mcq_question_id');
            $table->float('gain_marks');
            $table->foreign('model_exam_id')
                ->references('id')->on('model_exams')
                ->onDelete('cascade');
            $table->foreign('student_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('exam_tag_id')
                ->references('id')->on('exam_tags')
                ->onDelete('cascade');
            $table->foreign('mcq_question_id')
                ->references('id')->on('mcq_questions')
                ->onDelete('cascade');
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
        Schema::dropIfExists('model_mcq_tag_analysis');
    }
}
