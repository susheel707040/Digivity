<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimetableRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timetable_record', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_id');
            $table->unsignedInteger('branches_id');
            $table->unsignedInteger('academic_id');
            $table->unsignedInteger('course_id');
            $table->unsignedInteger('section_id');
            $table->unsignedInteger('timetable_id');
            $table->string('file_name');
            $table->string('file_path');
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
        Schema::dropIfExists('timetable_record');
    }
}
