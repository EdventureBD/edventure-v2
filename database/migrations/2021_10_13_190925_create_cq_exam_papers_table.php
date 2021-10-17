<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCqExamPapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cq_exam_papers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_id');
            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');

            $table->string('exam_type');
            $table->unsignedBigInteger('creative_question_id');
            $table->foreign('creative_question_id')
                ->references('id')
                ->on('creative_questions')
                ->onDelete('cascade');

            $table->unsignedBigInteger('batch_id');
            $table->foreign('batch_id')->references('id')->on('batches')->onDelete('cascade');

            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');

            $table->text('submitted_text')->nullable();
            $table->string('submitted_pdf')->nullable();
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
        Schema::dropIfExists('cq_exam_papers');
    }
}
