<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrontOfficeEnquiryRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('front_office_enquiry_record', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_id');
            $table->unsignedInteger('branches_id');
            $table->unsignedInteger('academic_id');
            $table->string('enquiry_no');
            $table->date('enquiry_date');
            $table->string('apply_for');
            $table->date('reminder_date');
            $table->string('applicant_name');
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('mobile_no');
            $table->string('email_id')->nullable();
            $table->string('address')->nullable();
            $table->string('status')->nullable();
            $table->string('observation')->nullable();
            $table->text('know_of_school');
            $table->text('remark')->nullable();
            $table->string('attachment')->nullable();
            $table->string('session_id')->nullable();
            $table->unsignedInteger('course_id')->nullable();
            $table->unsignedInteger('department_id')->nullable();
            $table->unsignedInteger('designation_id')->nullable();
            $table->text('applicant_info')->nullable();
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
        Schema::dropIfExists('front_office_enquiry_record');
    }
}
