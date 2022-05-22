<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PopulateTeachersColumnInExamCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $exam_categories = \App\Models\ExamCategory::query()->get();

        foreach ($exam_categories as $category) {
            $category['teachers'] = ["{\"id\":3,\"order\":2}","{\"id\":4,\"order\":1}"];
            $category->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exam_categories', function (Blueprint $table) {
            //
        });
    }
}
