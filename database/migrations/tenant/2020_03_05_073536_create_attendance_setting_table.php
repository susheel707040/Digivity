<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_setting', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_id');
            $table->unsignedInteger('branches_id');
            $table->unsignedInteger('academic_id');
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
        Schema::dropIfExists('attendance_setting');
    }
}
