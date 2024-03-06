<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceStudentFeeHeadFineConcessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_student_fee_head_fine_concession', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('financial_id');
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('fee_head_id');
            $table->string('foreign_fee_head_id');
            $table->string('instalment_id');
            $table->enum('instalment_avoid', ['yes', 'no'])->default('no')->index();
            $table->string('concession_type');
            $table->decimal('concession');
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
        Schema::dropIfExists('finance_student_fee_head_fine_concession');
    }
}
