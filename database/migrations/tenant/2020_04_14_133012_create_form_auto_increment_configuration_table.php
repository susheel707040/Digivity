<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormAutoIncrementConfigurationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_auto_increment_configuration', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_id');
            $table->unsignedInteger('branches_id');
            $table->unsignedInteger('academic_id');
            $table->string('key_id');
            $table->enum('should_be',['auto','manuel'])->default('auto');
            $table->enum('p_s_support_date',['yes','no'])->default('no');
            $table->string('prefix')->nullable();
            $table->string('prefix_date')->nullable();
            $table->string('start_from')->nullable();
            $table->string('suffix')->nullable();
            $table->string('suffix_date')->nullable();
            $table->enum('status',['yes','no'])->default('yes');
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
        Schema::dropIfExists('form_auto_increment_configuration');
    }
}
