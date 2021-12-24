<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_tags', function (Blueprint $table) {
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

            $table->unsignedBigInteger('lecture_id');
            $table->foreign('lecture_id')
                ->references('id')->on('course_lectures')
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
        Schema::dropIfExists('content_tags');
    }
}
