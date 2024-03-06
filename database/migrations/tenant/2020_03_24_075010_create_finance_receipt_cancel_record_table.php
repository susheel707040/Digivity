<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceReceiptCancelRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_receipt_cancel_record', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('receipt_id');
            $table->date('cancel_date');
            $table->enum('receipt_status',['paid','unpaid','cancel'])->default('paid');
            $table->longText('reason')->nullable();
            $table->longText('attachment_file')->nullable();
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
        Schema::dropIfExists('finance_receipt_cancel_record');
    }
}
