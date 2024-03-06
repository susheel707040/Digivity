<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceFeeCollectionRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_fee_collection_record', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_id');
            $table->unsignedInteger('branches_id');
            $table->unsignedInteger('financial_id');
            $table->string('receipt_group_token_id');
            $table->string('receipt_id');
            $table->date('receipt_date');
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('prospectus_id')->nullable();
            $table->unsignedInteger('course_id');
            $table->unsignedInteger('section_id')->nullable();
            $table->decimal('sub_total')->default(0);
            $table->decimal('concession_total')->default(0);
            $table->decimal('special_concession')->default(0);
            $table->decimal('fine_total')->default(0);
            $table->decimal('fine_concession')->default(0);
            $table->decimal('fee_payable')->default(0);
            $table->decimal('paid_amount')->default(0);
            $table->decimal('balance')->default(0);
            $table->enum('entry_mode', ['school','bank','online'])->default('school')->index();
            $table->string('online_transaction_no')->nullable();
            $table->text('online_remark')->nullable();
            $table->enum('online_status', ['unpaid','paid','cancel'])->default('unpaid')->index();
            $table->unsignedInteger('paymode_id')->nullable();
            $table->string('instrument_no')->nullable();
            $table->date('instrument_date')->nullable();
            $table->string('bank')->nullable();
            $table->enum('receipt_status', ['unpaid','paid','cancel'])->default('unpaid')->index();
            $table->text('concession_remark')->nullable();
            $table->text('special_concession_remark')->nullable();
            $table->text('fine_remark')->nullable();
            $table->text('fee_remark')->nullable();
            $table->string('custom_fee_id')->nullable();
            $table->string('new_custom_fee_id')->nullable();
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
        Schema::dropIfExists('finance_fee_collection_record');
    }
}
