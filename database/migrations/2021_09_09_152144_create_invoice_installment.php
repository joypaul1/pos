<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceInstallment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_installments', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->unsignedInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->foreign('payment_id')->references('id')->on('invoice_payments');
            $table->unsignedBigInteger('invoice_id');
            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->date('date');
            $table->boolean('status')->default(false);
            $table->decimal('amount', 8 , 2)->default('0');
            $table->decimal('paid_amount',8 , 2)->default('0');
            $table->decimal('due_amount',8 , 2)->virtualAs('amount - paid_amount');
            $table->date('paid_date')->nullable();
            $table->tinyInteger('interest');
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
        Schema::dropIfExists('invoice_installment');
    }
}
