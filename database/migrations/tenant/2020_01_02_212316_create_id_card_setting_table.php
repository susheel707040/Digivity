<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdCardSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('id_card_setting', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id')->unsigned();
            $table->integer('branches_id')->unsigned();
            $table->integer('academic_id')->unsigned();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->string('font-size')->nullable();
            $table->string('font-weight')->nullable();
            $table->string('font-family')->nullable();
            $table->string('padding')->nullable();
            $table->string('margin')->nullable();
            $table->string('background_image')->nullable();
            $table->integer('server_id')->unsigned();
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
        Schema::dropIfExists('id_card_setting');
    }
}
