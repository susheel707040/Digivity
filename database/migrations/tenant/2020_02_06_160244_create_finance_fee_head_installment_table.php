<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceFeeHeadInstallmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_fee_head_instalment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('financial_id')->unsigned();
            $table->integer('pay_id')->unsigned()->nullable();
            $table->integer('fee_head_id')->unsigned();
            $table->string('foreign_fee_head_id');
            $table->string('pay_type');
            $table->string('instalment_id');
            $table->string('instalment_unique_id')->nullable();
            $table->string('print_name');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('fine_apply', ['yes', 'no'])->default('no')->index();
            $table->string('concession_type');
            $table->decimal('concession')->default(0);
            $table->string('custom_fee_id')->nullable();
            $table->boolean('sequence');
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
        Schema::dropIfExists('finance_fee_head_instalment');
    }
}
