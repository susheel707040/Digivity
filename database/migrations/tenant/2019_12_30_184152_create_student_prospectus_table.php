<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentProspectusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_prospectus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id')->unsigned();
            $table->integer('branches_id')->unsigned();
            $table->integer('academic_id')->unsigned();
            $table->integer('financial_id')->unsigned();
            $table->string('pros_no');
            $table->date('admission_date');
            $table->text('reference')->nullable();
            $table->integer('admission_type_id')->unsigned()->nullable();
            $table->integer('course_id')->unsigned();
            $table->integer('board_id')->unsigned()->nullable();
            $table->string('transport_id')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('aadhar_no')->nullable();
            $table->string('father_name')->nullable();
            $table->string('f_qualification')->nullable();
            $table->string('f_annual_income')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('m_qualification')->nullable();
            $table->string('m_annual_income')->nullable();
            $table->string('person_name')->nullable();
            $table->string('mobile_no',30);
            $table->string('email_id')->nullable();
            $table->longText('residence_address')->nullable();
            $table->longText('permanent_address')->nullable();
            $table->text('landmark')->nullable();
            $table->string('city')->nullable();
            $table->string('pincode')->nullable();
            $table->string('state')->nullable();
            $table->string('student_photo')->default('assets/images/user_no_image.png');
            $table->enum('status',['approve','pending','reject','cancel','hold'])->default('pending');
            $table->enum('pay_status', ['pending', 'paid','fail','cancel'])->default('pending')->index();
            $table->decimal('payable_amt')->default(0);
            $table->decimal('paid_amt')->default(0);
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
        Schema::dropIfExists('student_prospectus');
    }
}
