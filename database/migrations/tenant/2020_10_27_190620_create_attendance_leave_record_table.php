<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceLeaveRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_leave_record', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id')->unsigned();
            $table->integer('branches_id')->unsigned();
            $table->integer('academic_id')->unsigned();
            $table->enum('leave_to',['student','staff'])->default('student');
            $table->integer('student_id')->unsigned()->nullable();
            $table->integer('staff_id')->unsigned()->nullable();
            $table->string('total_leave')->default(0);
            $table->integer('leave_type_id')->unsigned()->nullable();
            $table->longText('reason')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('leave_status',['pending','reject','cancel','approve'])->default('pending');
            $table->longText('leave_status_reason')->nullable();
            $table->integer('approve_by_user_id')->nullable();
            $table->timestamp('leave_status_updated')->nullable();
            $table->longText('document_ids')->nullable();
            $table->integer('user_id')->unsigned();
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
        Schema::dropIfExists('attendance_leave_record');
    }
}
