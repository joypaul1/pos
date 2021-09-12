<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddtionalCloumnToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('model_Of_vehicle')->nullable();
            $table->string('class_Of_vehicle')->nullable();
            $table->string('chasiss_no')->nullable();
            $table->string('engine_no')->nullable();
            $table->string('key_no')->nullable();
            $table->string('none_of_cylineder_with_cc')->nullable();
            $table->string('colour')->nullable();
            $table->string('size')->nullable();
            $table->string('year_of_manufacture/assembel')->nullable();
            $table->string('hourse_power')->nullable();
            $table->string('laden_weight')->nullable();
            $table->string('wheel_base')->nullable();
            $table->string('seating_capacity')->nullable();
            $table->string("makers_Name")->nullable();
            $table->string("unit_price")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
