<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialExamCqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_exam_cqs', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->integer('marks');

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
        Schema::dropIfExists('special_exam_cqs');
    }
}
