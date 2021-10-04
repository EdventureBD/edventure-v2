<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMCQSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_c_q_s', function (Blueprint $table) {
            $table->id();
            $table->uuid('slug');
            $table->longText('question')->nullable();;
            $table->string('image')->nullable();
            $table->longText('field1')->nullable();
            $table->longText('field2')->nullable();
            $table->longText('field3')->nullable();
            $table->longText('field4')->nullable();
            $table->integer('answer');
            $table->unsignedBigInteger('exam_id');
            $table->foreign('exam_id')
                ->references('id')->on('exams')
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
        Schema::dropIfExists('m_c_q_s');
    }
}
