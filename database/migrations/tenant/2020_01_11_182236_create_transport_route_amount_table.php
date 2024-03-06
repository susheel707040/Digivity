<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportRouteAmountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transport_route_amount', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('route_relation_id')->unsigned();
            $table->integer('academic_id')->unsigned();
            $table->integer('financial_id')->unsigned();
            $table->integer('fees_id')->unsigned();
            $table->string('fees_term_id');
            $table->decimal('amount');
            $table->integer('user_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('route_relation_id')->references('id')->on('transport_route_relations');
            $table->foreign('academic_id')->references('id')->on('academic_sessions');
            $table->foreign('financial_id')->references('id')->on('financial_sessions');
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
        Schema::dropIfExists('transport_route_amount');
    }
}
