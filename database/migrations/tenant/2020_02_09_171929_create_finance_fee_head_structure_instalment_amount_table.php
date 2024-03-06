<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceFeeHeadStructureInstalmentAmountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
{
    Schema::create('finance_fee_head_structure_instalment_amount', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('fee_head_structure_id')->unsigned();
        $table->integer('fee_group_id')->unsigned()->nullable();
        $table->integer('fee_head_id')->unsigned();
        $table->string('instalment_id'); // Remove unsigned for string column
        $table->string('fee_amount')->default('1'); // Set a default value for the string column
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
        Schema::dropIfExists('finance_fee_head_structure_instalment_amount');
    }
}
