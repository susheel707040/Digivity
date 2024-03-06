<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceConcessionAssignSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_concession_assign_setting', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('financial_id')->unsigned();
            $table->integer('concession_type_id')->unsigned();
            $table->integer('fee_head_id')->unsigned();
            $table->string('foreign_fee_head_id');
            $table->string('instalment_id');
            $table->string('concession_type');
            $table->decimal('concession');
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
        Schema::dropIfExists('finance_concession_assign_setting');
    }
}
