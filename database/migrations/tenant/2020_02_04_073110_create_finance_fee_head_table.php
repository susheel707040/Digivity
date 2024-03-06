<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceFeeHeadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_fee_head', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id')->unsigned();
            $table->integer('branches_id')->unsigned();
            $table->integer('financial_id')->unsigned();
            $table->string('fee_head');
            $table->string('print_line_one')->nullable();
            $table->string('print_line_two')->nullable();
            $table->string('type')->nullable();
            $table->enum('refund', ['yes', 'no'])->default('no')->index();
            $table->enum('apply', ['yes', 'no'])->default('yes')->index();
            $table->boolean('priority');
            $table->enum('fee_custom', ['yes', 'no'])->default('no')->index();
            $table->enum('form_sale',['yes','no'])->default('no');
            $table->integer('user_id')->unsigned();
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
        Schema::dropIfExists('finance_fee_head');
    }
}
