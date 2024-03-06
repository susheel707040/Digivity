<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceReceiptModifyRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_receipt_modify_record', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('receipt_id');
            $table->date('modify_date');
            $table->longText('old_receipt_record')->nullable();
            $table->longText('receipt_update_record')->nullable();
            $table->longText('modify_reason');
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
        Schema::dropIfExists('finance_receipt_modify_record');
    }
}
