<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBatchRankToBatchStudentEnrollment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('batch_student_enrollments', function (Blueprint $table) {
            $table->integer('batch_rank')->nullable()->after('student_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('batch_student_enrollments', function (Blueprint $table) {
            $table->dropColumn('batch_rank');
        });
    }
}
