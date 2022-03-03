<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMcqQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mcq_questions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('model_exam_id');
            $table->unsignedBigInteger('exam_tag_id');
            $table->string('slug');
            $table->longText('question');
            $table->longText('field_1');
            $table->longText('field_2');
            $table->longText('field_3');
            $table->longText('field_4');
            $table->integer('answer');
            $table->longText('explanation');
            $table->foreign('model_exam_id')->references('id')->on('model_exams')->onDelete('cascade');
            $table->foreign('exam_tag_id')->references('id')->on('exam_tags')->onDelete('cascade');

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
        Schema::dropIfExists('mcq_questions');
    }
}
