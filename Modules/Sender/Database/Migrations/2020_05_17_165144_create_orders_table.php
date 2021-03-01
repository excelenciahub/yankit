<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sender_id')->unsigned()->nullable();
            $table->bigInteger('journey_id')->unsigned()->nullable();
            $table->bigInteger('departure_airport_id')->unsigned()->nullable();
            $table->bigInteger('destination_airport_id')->unsigned()->nullable();
            $table->string('title')->nullable();
            $table->string('weight')->nullable();
            $table->date('pickup_date');
            $table->dateTime('pickup_start_time');
            $table->dateTime('pickup_end_time');
            $table->text('description')->nullable();
            $table->text('custom_address')->nullable();
            $table->text('note')->nullable();
            $table->date('delevery_date')->nullable();
            $table->enum('status', ['Pending', 'Processing', 'Approved', 'Assigned', 'On Hold', 'Picked Up', 'Delivered', 'Rejected', 'Cancelled'])->default('Pending');
            $table->enum('payment_status', ['Pending', 'Success', 'Failed'])->default('Pending');
            $table->timestamps();

            $table->foreign('sender_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('journey_id')->references('id')->on('journeys')->onDelete('set null');
            $table->foreign('departure_airport_id')->references('id')->on('airports')->onDelete('set null');
            $table->foreign('destination_airport_id')->references('id')->on('airports')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
