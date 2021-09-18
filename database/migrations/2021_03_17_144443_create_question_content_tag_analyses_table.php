<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionContentTagAnalysesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_content_tag_analyses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('content_tag_id');
            $table->foreign('content_tag_id')->references('id')->on('content_tags')->onDelete('cascade');

            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('exam_type');
            $table->unsignedBigInteger('question_id');
            $table->integer('number_of_attempt');
            $table->integer('gain_marks');
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
        Schema::dropIfExists('question_content_tag_analyses');
    }
}
