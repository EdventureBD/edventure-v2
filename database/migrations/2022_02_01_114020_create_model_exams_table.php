<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_exams', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('exam_topic_id');
            $table->unsignedBigInteger('exam_category_id');
            $table->integer('question_limit');
            $table->integer('exam_type');
            $table->bigInteger('duration');
            $table->boolean('negative_marking')
                    ->default(0)
                    ->comment('0 => negative marking not allow , 1 => allow negative marking');
            $table->float('negative_marking_value')->nullable();
            $table->boolean('visibility')
                    ->default(0)
                    ->comment('0 => exam is not publicly visible, 1 => exam is publicly visible ');
            $table->integer('per_question_marks')->nullable();
            $table->integer('total_exam_marks')->nullable();
            $table->longText('solution_pdf')->nullable();
            $table->longText('solution_video')->nullable();
            $table->integer('exam_price')->default(0);
            $table->foreign('exam_topic_id')->references('id')->on('exam_topics')->onDelete('cascade');
            $table->foreign('exam_category_id')->references('id')->on('exam_categories')->onDelete('cascade');
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
        Schema::dropIfExists('model_exams');
    }
}
