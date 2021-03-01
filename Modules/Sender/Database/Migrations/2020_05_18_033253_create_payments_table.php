<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id')->unsigned()->nullable();
            $table->enum('payment_method', ['Pending', 'Paypal', 'Stripe'])->default('Pending');
            $table->date('payment_date');
            $table->string('currency_symbol');
            $table->string('currency_code');
            $table->integer('price');
            $table->text('description')->nullable();
            $table->text('note')->nullable();
            $table->longText('payment_data')->nullable();
            $table->enum('payment_status', ['Pending', 'Success', 'Failed'])->default('Pending');
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
