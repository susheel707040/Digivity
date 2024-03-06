<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceFeeCollectionInstalmentRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_fee_collection_instalment_record', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('fee_collection_id');
            $table->text('receipt_group_token_id');
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('fee_collection_fee_head_id');
            $table->unsignedInteger('fee_structure_id');
            $table->unsignedInteger('fee_head_id');
            $table->string('custom_fee_id')->nullable();
            $table->boolean('fee_head_priority')->default(0);
            $table->string('instalment_id');
            $table->string('instalment_unique_id')->nullable();
            $table->boolean('instalment_priority')->default(0);
            $table->string('instalment_print_name');
            $table->decimal('instalment_amount')->default(0);
            $table->decimal('instalment_concession')->default(0);
            $table->decimal('instalment_fine')->default(0);
            $table->decimal('instalment_total_amount')->default(0);
            $table->decimal('instalment_paid')->default(0);
            $table->decimal('instalment_bal')->default(0);
            $table->enum('paid_status', ['unpaid','paid'])->default('unpaid')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finance_fee_collection_instalment_record');
    }
}
