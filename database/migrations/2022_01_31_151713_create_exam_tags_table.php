<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('exam_topic_id');
            $table->string('solution_pdf')->nullable();
            $table->string('solution_video')->nullable();
            $table->timestamps();
            $table->foreign('exam_topic_id')->references('id')->on('exam_topics')->onDelete('cascade');
            $table->unique(["name", "exam_topic_id"],'unique_name_topic');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::enableForeignKeyConstraints();
        Schema::table('exam_tags', function (Blueprint $table) {
            $table->dropForeign(['exam_topic_id']);
            $table->dropUnique('unique_name_topic');
        });
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('exam_tags');
    }
}
