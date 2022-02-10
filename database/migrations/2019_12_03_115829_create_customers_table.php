<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->nullable();
            $table->string('name');
            $table->string('father_name');
            $table->string('mother_name')->nullable();
            $table->string('district')->nullable();
            $table->string('up')->nullable();
            $table->string('post_office')->nullable();
             $table->string('village')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->double('total_amount')->nullable();
            $table->double('due')->nullable();
            $table->double('payment')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
