<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicePaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_payment_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('invoice_id')->nullable();
            $table->longText('description')->nullable();
            $table->double('current_paid_amount')->nullable();
            $table->date('date')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('cheque_no')->nullable();
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
        Schema::dropIfExists('invoice_payment_details');
    }
}
