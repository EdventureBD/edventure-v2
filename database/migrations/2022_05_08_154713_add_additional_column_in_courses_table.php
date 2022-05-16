<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalColumnInCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->integer('time_allotted');
            $table->string('video_lecture')->nullable()->default(0);
            $table->string('given_notes')->nullable()->default(0);
            $table->string('quiz')->nullable()->default(0);
            $table->string('mind_map')->nullable()->default(0);
            $table->longText('course_for_whom')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('time_allotted');
            $table->dropColumn('video_lecture');
            $table->dropColumn('given_notes');
            $table->dropColumn('quiz');
            $table->dropColumn('mind_map');
            $table->dropColumn('course_for_whom');
        });
    }
}
