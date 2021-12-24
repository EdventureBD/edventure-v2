<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchLecturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_lectures', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('batch_id');
            $table->foreign('batch_id')
                ->references('id')->on('batches')
                ->onDelete('cascade');

            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')
                ->references('id')->on('courses')
                ->onDelete('cascade');

            $table->unsignedBigInteger('topic_id');
            $table->foreign('topic_id')
                ->references('id')->on('course_topics')
                ->onDelete('cascade');

            $table->tinyInteger('status');
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
        Schema::dropIfExists('batch_lectures');
    }
}
