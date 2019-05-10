<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings_services', function (Blueprint $table) {
            $table->bigIncrements('id');
                        $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('service_id');
            $table->foreign('booking_id')
            ->references('id')->on('bookings')
            ->onDelete('cascade');
            $table->foreign('service_id')
            ->references('id')->on('services')
            ->onDelete('cascade');
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
        Schema::dropIfExists('bookings_services');
    }
}
