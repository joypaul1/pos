<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('unit_id')->nullable();
            $table->string('name')->unique()->nullable();
            $table->string('sheif_no')->unique()->nullable();
            $table->integer('quantity')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->integer('free_quantity')->default(0);
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
        Schema::dropIfExists('products');
    }
}
