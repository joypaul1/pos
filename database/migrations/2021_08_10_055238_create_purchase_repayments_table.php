<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseRepaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_repayments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('purchase_id')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->double('new_paid_amount')->nullable();
            $table->date('date')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('paid_status')->nullable();
            $table->double('paid_amount')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('cheque_no')->nullable();
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
        Schema::dropIfExists('purchase_repayments');
    }
}
