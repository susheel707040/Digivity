<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_record', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id')->unsigned();
            $table->integer('branches_id')->unsigned();
            $table->integer('financial_id')->unsigned();
            $table->integer('ac_user_id')->unsigned()->nullable();
            $table->date('joining_date');
            $table->string('staff_no');
            $table->date('date_of_retire')->nullable();
            $table->date('date_of_extend')->nullable();
            $table->unsignedSmallInteger('profession_type_id')->nullable();
            $table->unsignedSmallInteger('staff_type_id')->nullable();
            $table->unsignedSmallInteger('department_id');
            $table->unsignedSmallInteger('designation_id');
            $table->enum('show_in_transport', ['yes', 'no'])->default('no')->index();
            $table->unsignedSmallInteger('transport_id')->nullable();
            $table->unsignedSmallInteger('hostel_id')->nullable();
            $table->integer('shift_id')->unsigned()->nullable();
            $table->string('integrated_id')->nullable();
            $table->string('title');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('blood_group')->nullable();
            $table->date('dob')->nullable();
            $table->date('doa')->nullable();
            $table->integer('nationality_id')->unsigned()->nullable();
            $table->integer('religion_id')->unsigned()->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('caste_id')->unsigned()->nullable();
            $table->integer('parish_id')->unsigned()->nullable();
            $table->string('aadhaar_no')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('license_no')->nullable();
            $table->string('passport_no')->nullable();
            $table->string('contact_no');
            $table->string('alt_mobile_no')->nullable();
            $table->string('email')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('father_mobile_no')->nullable();
            $table->enum('marital_status', ['married','unmarried','others'])->default('married')->index();
            $table->string('spouse_name')->nullable();
            $table->string('spouse_mobile_no')->nullable();
            $table->longText('residence_address')->nullable();
            $table->longText('permanent_address')->nullable();
            $table->string('landmark')->nullable();
            $table->string('city')->nullable();
            $table->string('pincode')->nullable();
            $table->string('state')->nullable();
            $table->string('ex_year')->nullable();
            $table->string('ex_month')->nullable();
            $table->string('ex_day')->nullable();
            $table->longText('ex_description')->nullable();
            $table->integer('paymode_id')->unsigned()->nullable();
            $table->string('account_number')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('bank_name')->nullable();
            $table->text('bank_location')->nullable();
            $table->enum('generate_salary',['yes','no'])->default('yes');
            $table->enum('salary_to_bank',['yes','no'])->default('yes');
            $table->string('gratuity_code')->nullable();
            $table->string('emp_status')->nullable();
            $table->string('pf_no')->nullable();
            $table->string('esi_no')->nullable();
            $table->string('uan_no')->nullable();
            $table->string('dispensary')->nullable();
            $table->string('nominee_name')->nullable();
            $table->string('nominee_relation')->nullable();
            $table->enum('pension',['yes','no'])->default('no')->index();
            $table->string('machine_no')->nullable();
            $table->string('rfid_no')->nullable();
            $table->string('gps_no')->nullable();
            $table->string('attendance')->nullable();
            $table->string('profile_img')->default('assets/images/user_no_image.png');
            $table->string('username')->nullable();
            $table->string('psw')->nullable();
            $table->unsignedSmallInteger('user_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('school_id')->references('id')->on('school_information');
            $table->foreign('branches_id')->references('id')->on('school_branches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff_record');
    }
}
