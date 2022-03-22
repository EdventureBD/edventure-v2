<?php

use App\Models\PaymentOfCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTnxIdColumnInPaymentOfCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_of_categories', function (Blueprint $table) {
            $table->string('tnx_id')->after('user_id');
        });

        $paymentOfCategories = PaymentOfCategory::query()->with('singlePayment')->get();

        foreach ($paymentOfCategories as $catPayment) {
            $catPayment->tnx_id = $catPayment->singlePayment->tnx_id;
            $catPayment->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_of_categories', function (Blueprint $table) {
            $table->dropColumn('tnx_id');
        });
    }
}
