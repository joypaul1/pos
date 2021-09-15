<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $dropTable = ['invoice_repayments', 'invoice_payments', 'invoice_payment_due_logs', 'invoice_payment_details', 'invoice_installments', 'invoice_details', 'invoices'];

        foreach($dropTable as $table){
            Schema::dropIfExists($table);
        }

        Schema::create('invoices', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->string('invoice_no')->nullable();
            $table->unsignedInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->date('date')->nullable();
            $table->decimal('total_amount', 8 , 2);
            $table->decimal('grand_total', 8 , 2);
            $table->decimal('paid_amount',8 , 2)->default('0');
            $table->decimal('due_amount',8 , 2)->virtualAs('grand_total - paid_amount');
            $table->decimal('discount_amount',8 , 2)->default('0');
            $table->tinyInteger('status')->default(false)->comment('0=Pending,1=Approved,2=Repayment Pending');
            $table->longText('description')->nullable();
            $table->unsignedInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users')->nullable();
            $table->timestamps();
        });

        Schema::create('invoice_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('invoice_id');
            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->decimal('selling_qty',8 , 2)->default('0');
            $table->decimal('free_selling_qty',8 , 2)->default('0');
            $table->decimal('unit_price',8 , 2)->default('0');
            $table->decimal('selling_price',8 , 2)->default('0');
            $table->decimal('total_price',8 , 2)->default('0');
            $table->decimal('atcual_total_price',8 , 2)->default('0');
            $table->string('serial_no')->nullable();
            $table->string('warranty')->nullable();
            $table->boolean('status')->default(1);
            $table->unsignedInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users')->nullable();
            $table->timestamps();
        });

        Schema::create('invoice_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('invoice_id');
            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->unsignedInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->string('paid_status',51)->nullable();
            $table->string('payment_method',91)->nullable();
            $table->boolean('status')->default('0')->comment('0=Due,1=Paid');
            $table->unsignedInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users')->nullable();
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

    }
}
