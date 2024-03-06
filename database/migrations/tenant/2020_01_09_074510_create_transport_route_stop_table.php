<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportRouteStopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transport_route_stop', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id')->unsigned();
            $table->integer('branches_id')->unsigned();
            $table->boolean('sequence')->nullable();
            $table->string('stop_no')->nullable();
            $table->string('route_stop');
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->text('map_api_url')->nullable();
            $table->boolean('school_to_stop_distance')->nullable();
            $table->boolean('stop_to_school_distance')->nullable();
            $table->text('note')->nullable();
            $table->integer('user_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('school_id')->references('id')->on('school_information');
            $table->foreign('branches_id')->references('id')->on('school_branches');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transport_route_stop');
    }
}
