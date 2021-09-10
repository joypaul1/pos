<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasePaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_payment_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchase_id')->nullable();
            $table->integer('current_paid_amount')->nullable();
            $table->date('date')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('cheque_no')->nullable();
            $table->tinyInteger('paid_type')->default(1)->comment('1 = invoice, 0=advance purchase');
            $table->integer('created_by')->nullable();
            $table->integer('modified_by')->nullable();
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
        Schema::dropIfExists('purchase_payment_details');
    }
}
