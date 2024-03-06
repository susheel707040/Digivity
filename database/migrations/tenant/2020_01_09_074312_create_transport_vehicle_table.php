<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportVehicleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transport_vehice', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id')->unsigned();
            $table->integer('branches_id')->unsigned();
            $table->integer('vehicle_type_id')->unsigned();
            $table->string('vehicle_name');
            $table->string('registration_no');
            $table->string('registration_date');
            $table->string('no_of_seat')->nullable();
            $table->string('max_allow')->nullable();
            $table->string('mileage_km')->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('owner_name')->nullable();
            $table->string('mobile_no')->nullable();
            $table->integer('user_id')->unsigned();
            $table->softDeletes();
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
        Schema::dropIfExists('transport_vehice');
    }
}
