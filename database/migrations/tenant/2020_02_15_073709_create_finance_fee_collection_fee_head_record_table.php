<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceFeeCollectionFeeHeadRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_fee_collection_fee_head_record', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('fee_collection_id');
            $table->unsignedInteger('fee_structure_id');
            $table->unsignedInteger('fee_head_id');
            $table->string('custom_fee_id')->nullable();
            $table->boolean('priority')->default(0);
            $table->decimal('sub_total')->default(0);
            $table->decimal('concession_total')->default(0);
            $table->decimal('fine_total')->default(0);
            $table->decimal('total')->default(0);
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
        Schema::dropIfExists('finance_fee_collection_fee_head_record');
    }
}
