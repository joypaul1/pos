<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceRepaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_repayments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('invoice_id')->nullable();
            $table->double('due_paid_amount')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('invoice_repayments');
    }
}
