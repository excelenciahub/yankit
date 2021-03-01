<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id')->unsigned()->nullable();
            $table->bigInteger('package_id')->unsigned()->nullable();
            $table->string('weight')->nullable();
            $table->string('currency_symbol')->nullable();
            $table->string('currency_code')->nullable();
            $table->integer('price')->nullable();
            $table->text('description')->nullable();
            $table->date('delevery_date')->nullable();
            $table->date('payment_date')->nullable();
            $table->enum('status', ['Pending', 'Processing', 'Approved', 'Assigned', 'On Hold', 'Picked Up', 'Delivered', 'Rejected', 'Cancelled'])->default('Pending');
            $table->enum('payment_status', ['Pending', 'Success'])->default('Pending');
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('set null');
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
