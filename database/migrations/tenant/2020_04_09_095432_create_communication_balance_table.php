<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunicationBalanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communication_balance', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_id');
            $table->unsignedInteger('branches_id');
            $table->unsignedInteger('academic_id');
            $table->string('month');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('text_balance')->default(0);
            $table->decimal('text_use_balance')->default(0);
            $table->decimal('email_balance')->default(0);
            $table->decimal('email_use_balance')->default(0);
            $table->decimal('app_balance')->default(0);
            $table->decimal('app_use_balance')->default(0);
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
        Schema::dropIfExists('communication_balance');
    }
}
