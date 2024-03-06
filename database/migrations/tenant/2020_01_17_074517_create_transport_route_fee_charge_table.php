<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportRouteFeeChargeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transport_route_fee_charge', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('financial_id')->unsigned();
            $table->integer('route_relation_id')->unsigned();
            $table->string('instalment_id');
            $table->decimal('fee_amount')->default('0');
            $table->integer('user_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('financial_id')->references('id')->on('financial_sessions');
            $table->foreign('route_relation_id')->references('id')->on('transport_route_relations');
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
        Schema::dropIfExists('transport_route_fee_charge');
    }
}
