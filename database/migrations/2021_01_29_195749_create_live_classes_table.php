<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiveClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_classes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();

            $table->unsignedBigInteger('batch_id');
            $table->foreign('batch_id')
                ->references('id')->on('batches')
                ->onDelete('cascade');

            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')
                ->references('id')->on('courses')
                ->onDelete('cascade');

            $table->unsignedBigInteger('topic_id')->nullable();
            $table->foreign('topic_id')
                ->references('id')->on('course_topics')
                ->onDelete('cascade');

            $table->string('live_link');
            $table->time('start_time');
            $table->date('start_date');
            $table->time('show_link_limit_time')->nullable();
            $table->boolean('is_always_show')->nullable();
            $table->boolean('is_special')->nullable();;
            $table->integer('order');
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
        Schema::dropIfExists('live_classes');
    }
}
