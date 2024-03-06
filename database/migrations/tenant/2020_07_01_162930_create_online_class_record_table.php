<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlineClassRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_class_record', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_id');
            $table->unsignedInteger('branches_id');
            $table->unsignedInteger('academic_id');
            $table->longText('join_group_id');
            $table->string('password')->nullable();
            $table->unsignedInteger('member_id')->nullable();
            $table->unsignedInteger('online_for_id');
            $table->unsignedInteger('course_id');
            $table->unsignedInteger('section_id');
            $table->unsignedInteger('online_period_id');
            $table->timestamp('expire_date')->nullable();
            $table->boolean('online_minute')->default(0)->nullable();
            $table->boolean('joins')->default(0)->nullable();
            $table->enum('online_status',['1','0'])->default('1');
            $table->longText('third_party')->nullable();
            $table->longText('video_store_id')->nullable();
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
        Schema::dropIfExists('online_class_record');
    }
}
