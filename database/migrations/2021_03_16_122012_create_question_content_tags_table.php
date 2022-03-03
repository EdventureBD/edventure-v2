<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionContentTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_content_tags', function (Blueprint $table) {
            $table->id();
            $table->string('exam_type');

            $table->unsignedBigInteger('question_id');
            // $table->foreign('question_id')->references('id')->on('m_c_q_s')->on('c_q_s')->on('assignments')->onDelete('cascade');

            $table->unsignedBigInteger('content_tag_id');
            $table->foreign('content_tag_id')->references('id')->on('content_tags')->onDelete('cascade');
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
        Schema::dropIfExists('question_content_tags');
    }
}
