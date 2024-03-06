<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceHolidayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void  
     */
    public function up()
    {
        Schema::create('attendance_holiday', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_id');
            $table->unsignedInteger('branches_id');
            $table->unsignedInteger('academic_id');
            $table->enum('for_student',['1','0'])->default('0');
            $table->enum('for_staff',['1','0'])->default('0');
            $table->string('holiday')->nullable();
            $table->longText('description')->nullable();
            $table->string('symbol')->nullable();
            $table->date('holiday_from_date');
            $table->date('holiday_to_date');
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
        Schema::dropIfExists('attendance_holiday');
    }
}
