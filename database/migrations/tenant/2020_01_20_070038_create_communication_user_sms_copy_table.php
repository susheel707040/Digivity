<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunicationUserSmsCopyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communication_user_sms_copy_table', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id')->unsigned();
            $table->integer('branches_id')->unsigned();
            $table->string('designation')->nullable();
            $table->string('name');
            $table->string('gender')->nullable();
            $table->string('mobile_no');
            $table->string('email_id')->nullable();
            $table->text('note')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active')->index();
            $table->integer('user_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('school_id')->references('id')->on('school_information');
            $table->foreign('branches_id')->references('id')->on('school_branches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('communication_user_sms_copy_table');
    }
}
