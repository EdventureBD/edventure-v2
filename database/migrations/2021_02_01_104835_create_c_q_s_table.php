<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCQSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_q_s', function (Blueprint $table) {
            $table->id();
            $table->longText('question');
            $table->uuid('slug');
            $table->string('image')->nullable();
            $table->integer('marks');

            $table->unsignedBigInteger('creative_question_id');
            $table->foreign('creative_question_id')
                ->references('id')->on('creative_questions')
                ->onDelete('cascade');

            $table->integer('number_of_attempt');
            $table->integer('gain_marks');
            $table->integer('success_rate');
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
        Schema::dropIfExists('c_q_s');
    }
}
