<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJourneysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journeys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('traveller_id')->unsigned()->nullable();
            $table->bigInteger('departure_airport_id')->unsigned()->nullable();
            $table->bigInteger('destination_airport_id')->unsigned()->nullable();
            $table->bigInteger('package_id')->unsigned()->nullable();
            $table->string('weight')->nullable();
            $table->string('currency_symbol')->nullable();
            $table->string('currency_code')->nullable();
            $table->integer('price')->nullable();
            $table->string('title')->nullable();
            $table->date('pickup_date');
            $table->dateTime('pickup_start_time');
            $table->dateTime('pickup_end_time');
            $table->text('description')->nullable();
            $table->text('note')->nullable();
            $table->enum('status', ['Pending', 'Approved', 'Assigned', 'On Hold', 'Picked Up', 'Delivered', 'Rejected'])->default('Pending');
            $table->enum('payment_status', ['Pending', 'Success'])->default('Pending');
            $table->timestamps();

            $table->foreign('traveller_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('departure_airport_id')->references('id')->on('airports')->onDelete('set null');
            $table->foreign('destination_airport_id')->references('id')->on('airports')->onDelete('set null');
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
        Schema::dropIfExists('journeys');
    }
}
