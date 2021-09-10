<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date')->nullable();
            $table->integer('purchase_id')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('buying_qty')->nullable();
            $table->integer('unit_price')->nullable();
            $table->integer('buying_price')->nullable();
            $table->double('selling_price')->nullable();
            $table->double('free_quantity')->nullable();
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
        Schema::dropIfExists('purchase_details');
    }
}
