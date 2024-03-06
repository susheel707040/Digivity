<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceStudentFeeHeadInstalmentConcessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_student_fee_head_instalment_concession', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('financial_id');
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('fee_head_id');
            $table->string('foreign_fee_head_id');
            $table->string('instalment_id');
            $table->string('concession_type');
            $table->decimal('concession');
            $table->unsignedInteger('fee_collection_id')->nullable();
            $table->enum('adjust_status',['1','0'])->default('0');
            $table->date('adjust_date')->nullable();
            $table->unsignedInteger('user_id');
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
        Schema::dropIfExists('finance_student_fee_head_instalment_concession');
    }
}
