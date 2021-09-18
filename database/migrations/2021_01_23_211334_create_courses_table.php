<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('logo')->nullable();
            $table->string('trailer')->nullable();

            $table->unsignedBigInteger('course_category_id');
            $table->foreign('course_category_id')
                ->references('id')->on('course_categories')
                ->onDelete('cascade');

            $table->text('description');
            $table->integer('price');
            $table->integer('duration');
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
        Schema::dropIfExists('courses');
    }
}
