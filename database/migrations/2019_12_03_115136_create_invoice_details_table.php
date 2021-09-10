<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->double('selling_qty')->nullable();
            $table->double('free_selling_qty')->nullable();
            $table->double('unit_price')->nullable();
            $table->double('selling_price')->nullable();
            $table->string('serial_no')->nullable();
            $table->string('warranty')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('invoice_details');
    }
}
