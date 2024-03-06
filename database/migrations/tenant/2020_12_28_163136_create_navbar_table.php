<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavbarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navbar', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id')->unsigned();
            $table->integer('module_id')->unsigned();
            $table->integer('branches_id')->unsigned();
            $table->boolean('sequence');
            $table->string('for');
            $table->string('parent_id')->nullable();
            $table->string('key');
            $table->longText('value');
            $table->longText('operation')->nullable();
            $table->longText('description')->nullable();
            $table->string('icon')->nullable();
            $table->longText('link')->nullable();
            $table->longText('default_value')->nullable();
            $table->enum('status',['1','0'])->default('1');
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
        Schema::dropIfExists('navbar');
    }
}
