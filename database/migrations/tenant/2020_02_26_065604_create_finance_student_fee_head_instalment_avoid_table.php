<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceStudentFeeHeadInstalmentAvoidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_student_fee_head_instalment_avoid', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('financial_id');
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('fee_head_id');
            $table->string('foreign_fee_head_id');
            $table->string('instalment_id');
            $table->unsignedSmallInteger('user_id');
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
        Schema::dropIfExists('finance_student_fee_head_instalment_avoid');
    }
}
