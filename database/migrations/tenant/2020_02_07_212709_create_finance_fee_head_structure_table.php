<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceFeeHeadStructureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_fee_head_structure', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('financial_id')->unsigned();
            $table->integer('pay_id')->unsigned()->nullable();
            $table->string('fee_to');
            $table->integer('fee_group_id')->unsigned()->nullable();
            $table->integer('student_id')->unsigned()->nullable();
            $table->string('fee_applicable')->nullable();
            $table->string('admission_category')->nullable();
            $table->integer('fee_head_id')->unsigned();
            $table->string('fee_type')->nullable();
            $table->string('foreign_fee_head_id');
            $table->decimal('fee_amount')->default(0);
            $table->string('custom_fee_id')->nullable();
            $table->boolean('custom_fee_pay_status')->nullable();
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
        Schema::dropIfExists('finance_fee_head_structure');
    }
}
