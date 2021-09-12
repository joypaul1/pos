<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddInterestAmountToInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::Satatement("ALTER TABLE `invoices` CHANGE `due_amount` `due_amount` DECIMAL(8,2) AS (`total_amount` + `intertest_amount`- `paid_amount`) VIRTUAL;");
        
        Schema::table('invoices', function (Blueprint $table) {
            $table->decimal('intertest_amount')->default(0.00)->after('discount_amount');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            //
        });
    }
}
