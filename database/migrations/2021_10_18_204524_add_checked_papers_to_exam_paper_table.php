<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCheckedPapersToExamPaperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_papers', function (Blueprint $table) {
            $table->string('checked_paper')->nullable()->after('submitted_pdf');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exam_papers', function (Blueprint $table) {
            $table->dropColumn('checked_paper');
        });
    }
}
