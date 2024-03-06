<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceReceiptChequeBounceEntryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_receipt_cheque_bounce_entry', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('financial_id');
            $table->unsignedInteger('receipt_id');
            $table->unsignedInteger('student_id');
            $table->text('reason');
            $table->unsignedInteger('fee_head_id');
            $table->decimal('fee_amount')->default(0);
            $table->text('attach_file')->nullable();
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
        Schema::dropIfExists('finance_receipt_cheque_bounce_entry');
    }
}
