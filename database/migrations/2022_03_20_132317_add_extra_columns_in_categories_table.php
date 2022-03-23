<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraColumnsInCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_categories', function (Blueprint $table) {
            $table->string('uuid')->after('name');
            $table->integer('time_allotted')->nullable()->default(0);
            $table->integer('full_solutions')->nullable()->default(0);
            $table->integer('paper_final')->nullable()->default(0);
            $table->integer('subject_final')->nullable()->default(0);
            $table->integer('final_exam')->nullable()->default(0);
            $table->json('teachers')->nullable();
            $table->string('routine_image')->nullable();
            $table->string('category_video')->nullable();
            $table->float('offer_price')->nullable()->default(0);
            $table->boolean('visibility')
                ->default(0)
                ->nullable()
                ->comment('0 => category is not publicly visible, 1 => category is publicly visible');

        });

        $categories = \App\Models\ExamCategory::query()->get();

        foreach ($categories as $category) {
            $category->uuid = uuid();
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
            $table->dropColumn('time_allotted');
            $table->dropColumn('full_solutions');
            $table->dropColumn('paper_final');
            $table->dropColumn('subject_final');
            $table->dropColumn('final_exam');
            $table->dropColumn('teachers');
            $table->dropColumn('routine_image');
            $table->dropColumn('category_video');
            $table->dropColumn('offer_price');
            $table->dropColumn('visibility');
        });
    }
}
