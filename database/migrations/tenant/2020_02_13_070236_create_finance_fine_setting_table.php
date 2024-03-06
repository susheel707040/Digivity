<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceFineSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_fine_setting', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_id');
            $table->unsignedInteger('branches_id');
            $table->unsignedInteger('financial_id');
            $table->unsignedInteger('fee_group_id');
            $table->unsignedInteger('fee_head_id');
            $table->string('foreign_fee_head_id');
            $table->string('instalment_id');
            $table->string('fine_type');
            $table->decimal('fine')->default(0);
            $table->decimal('instalment_max_limit')->default(0);
            $table->decimal('fine_max_limit')->default(0);
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
        Schema::dropIfExists('finance_fine_setting');
    }
}
