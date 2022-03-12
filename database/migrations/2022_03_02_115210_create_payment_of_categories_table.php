<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentOfCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_of_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_category_id');
            $table->unsignedBigInteger('single_payment_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('exam_category_id')->references('id')->on('exam_categories')->onDelete('cascade');
            $table->foreign('single_payment_id')->references('id')->on('single_payments')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('payment_of_categories');
    }
}
