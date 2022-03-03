<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_exams', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('batch_id');
            $table->foreign('batch_id')
                ->references('id')->on('batches')
                ->onDelete('cascade');

            $table->unsignedBigInteger('exam_id');
            $table->foreign('exam_id')
                ->references('id')->on('exams')
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
        Schema::dropIfExists('batch_exams');
    }
}
