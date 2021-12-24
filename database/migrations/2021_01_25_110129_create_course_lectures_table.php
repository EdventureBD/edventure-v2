<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseLecturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_lectures', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();

            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')
                ->references('id')->on('courses')
                ->onDelete('cascade');

            $table->unsignedBigInteger('topic_id');
            $table->foreign('topic_id')
                ->references('id')->on('course_topics')
                ->onDelete('cascade');

            $table->string('url');
            $table->longText('markdown_text')->nullable();
            $table->tinyInteger('status');
            $table->integer('order');
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
        Schema::dropIfExists('course_lectures');
    }
}
