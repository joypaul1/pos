<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportHeadingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_headings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('address')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('report_headings');
    }
}
