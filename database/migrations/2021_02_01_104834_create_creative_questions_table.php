<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreativeQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creative_questions', function (Blueprint $table) {
            $table->id();
            $table->longText('creative_question');
            $table->uuid('slug');
            $table->string('image')->nullable();

            $table->unsignedBigInteger('exam_id');
            $table->foreign('exam_id')
                ->references('id')->on('exams')
                ->onDelete('cascade');

            $table->integer('number_of_attempt');
            $table->integer('gain_marks');
            $table->integer('success_rate');
            $table->string('standard_ans_pdf');
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
        Schema::dropIfExists('creative_questions');
    }
}
