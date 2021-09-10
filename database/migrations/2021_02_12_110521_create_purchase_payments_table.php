<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchase_id')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->string('paid_status',51)->nullable();
            $table->string('payment_method',91)->nullable();
            $table->integer('paid_amount')->nullable();
            $table->integer('due_amount')->nullable();
            $table->integer('total_amount')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=Due,1=Paid');
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
        Schema::dropIfExists('purchase_payments');
    }
}
