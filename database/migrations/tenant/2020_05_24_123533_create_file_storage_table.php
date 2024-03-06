<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileStorageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_storage', function (Blueprint $table) {
            $table->increments('id');
            $table->string('integrate_id')->nullable();
            $table->string('storage');
            $table->longText('file_name');
            $table->string('extension')->nullable();
            $table->string('file_size')->nullable();
            $table->string('file_path');
            $table->longText('base64')->nullable();
            $table->string('cloud_id')->nullable();
            $table->unsignedInteger('user_id');
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
        Schema::dropIfExists('file_storage');
    }
}
