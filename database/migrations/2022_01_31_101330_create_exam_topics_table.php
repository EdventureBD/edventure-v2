<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_topics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('exam_category_id');
            $table->timestamps();
            $table->foreign('exam_category_id')->references('id')->on('exam_categories')->onDelete('cascade');
            $table->unique(["name", "exam_category_id"],'unique_name_category');
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
        Schema::table('exam_topics', function (Blueprint $table) {
            $table->dropForeign(['exam_category_id']);
            $table->dropUnique('unique_name_category');
        });
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('exam_topics');
    }
}
