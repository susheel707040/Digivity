<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_record', function (Blueprint $table) {
            $table->increments('id');
            $table->date('admission_date');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable()->nullable();
            $table->string('age')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('nationality')->nullable();
            $table->string('religion')->nullable();
            $table->string('caste')->nullable();
            $table->string('parish')->nullable();
            $table->string('aadhar_card_no')->nullable();
            $table->string('birth_certificate_no')->nullable();
            $table->string('rfid_no')->nullable();
            $table->string('gps_tracking_no')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('email')->nullable();
            $table->longText('residence_address')->nullable();
            $table->longText('permanent_address')->nullable();
            $table->longText('landmark')->nullable();
            $table->string('city')->nullable();
            $table->string('pin_code')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_mobile_no')->nullable();
            $table->string('father_email_id')->nullable();
            $table->string('father_qualification')->nullable();
            $table->string('father_annual_income')->nullable();
            $table->string('father_aadhar_card_no')->nullable();
            $table->string('father_profession')->nullable();
            $table->string('father_designation')->nullable();
            $table->string('father_organization_name')->nullable();
            $table->string('father_organization_address')->nullable();
            $table->string('father_organization_phone')->nullable();
            $table->integer('parent_status')->unsigned()->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_mobile_no')->nullable();
            $table->string('mother_email_id')->nullable();
            $table->string('mother_qualification')->nullable();
            $table->string('mother_annual_income')->nullable();
            $table->string('mother_aadhar_card_no')->nullable();
            $table->string('mother_profession')->nullable();
            $table->string('mother_designation')->nullable();
            $table->string('mother_organization_name')->nullable();
            $table->string('mother_organization_address')->nullable();
            $table->string('mother_organization_phone')->nullable();
            $table->date('anniversary_date')->nullable();
            $table->string('local_guardian_relation')->nullable();
            $table->string('local_guardian_name')->nullable();
            $table->string('local_guardian_mobile_no')->nullable();
            $table->string('local_guardian_email_id')->nullable();
            $table->string('local_guardian_qualification')->nullable();
            $table->string('local_guardian_annual_income')->nullable();
            $table->string('local_guardian_aadhar_card_no')->nullable();
            $table->string('local_guardian_profession')->nullable();
            $table->string('local_guardian_designation')->nullable();
            $table->string('local_guardian_org_name')->nullable();
            $table->string('local_guardian_org_address')->nullable();
            $table->string('local_guardian_org_phone')->nullable();
            $table->string('emergency_person_name')->nullable();
            $table->string('emergency_mobile_no')->nullable();
            $table->string('emergency_email_id')->nullable();
            $table->longText('emg_address')->nullable();
            $table->string('emg_relation')->nullable();
            $table->string('state')->nullable();
            $table->text('medical_history')->nullable();
            $table->text('allergie')->nullable();
            $table->string('family_doctor_name')->nullable();
            $table->string('family_doctor_phone',30)->nullable();
            $table->text('family_doctor_address')->nullable();
            $table->longText('other_medical_info')->nullable();
            $table->integer('staff_designation')->unsigned()->nullable();
            $table->integer('staff_id')->unsigned()->nullable();
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
        Schema::dropIfExists('student_record');
    }
}
