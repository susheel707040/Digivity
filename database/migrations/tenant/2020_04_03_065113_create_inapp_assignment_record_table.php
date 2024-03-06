<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInappAssignmentRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inapp_assignment_record', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_id');
            $table->unsignedInteger('branches_id');
            $table->unsignedInteger('academic_id');
            $table->enum('type',['all','student'])->default('student');
            $table->unsignedInteger('course_id')->nullable();
            $table->unsignedInteger('section_id')->nullable();
            $table->unsignedInteger('student_id')->nullable();
            $table->unsignedInteger('subject_id');
            $table->unsignedInteger('staff_id')->nullable();
            $table->date('assignment_date');
            $table->date('assigned_date');
            $table->date('submitted_date');
            $table->text('assignment_title');
            $table->longText('assignment');
            $table->dateTime('show_date_time')->nullable();
            $table->dateTime('end_date_time')->nullable();
            $table->enum('with_app',['yes','no'])->default('no');
            $table->enum('with_text_sms',['yes','no'])->default('no');
            $table->enum('with_email',['yes','no'])->default('no');
            $table->enum('with_website',['yes','no'])->default('no');
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
        Schema::dropIfExists('inapp_assignment_record');
    }
}
