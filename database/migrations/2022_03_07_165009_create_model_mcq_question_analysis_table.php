<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelMcqQuestionAnalysisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_mcq_question_analysis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('model_exam_id');
            $table->unsignedBigInteger('mcq_question_id');
            $table->integer('attempted');
            $table->integer('correct');
            $table->foreign('model_exam_id')
                ->references('id')->on('model_exams')
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
        Schema::dropIfExists('model_mcq_question_analysis');
    }
}
