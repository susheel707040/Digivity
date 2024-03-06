<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentAdmissionClassRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_admission_class_record', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id')->unsigned();
            $table->integer('branches_id')->unsigned();
            $table->integer('academic_id')->unsigned();
            $table->integer('financial_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->string('admission_no');
            $table->string('ac_ledger_no')->nullable();
            $table->integer('admission_type_id')->unsigned()->nullable();
            $table->integer('category_id')->nullable()->unsigned();
            $table->string('form_no')->nullable();
            $table->boolean('roll_no')->nullable();
            $table->integer('course_id')->unsigned();
            $table->integer('section_id')->unsigned();
            $table->integer('board_id')->nullable()->unsigned();
            $table->integer('house_id')->nullable()->unsigned();
            $table->integer('stream_id')->nullable()->unsigned();
            $table->string('subject_id')->nullable();
            $table->integer('fee_concession_id')->unsigned()->nullable();
            $table->string('fee_head_id_avoid')->nullable();
            $table->date('transport_start_date')->nullable();
            $table->integer('transport_id')->nullable();
            $table->enum('transport_status', ['active', 'inactive'])->default('active')->index();
            $table->date('transport_stop_date')->nullable();
            $table->integer('hostel_id')->unsigned()->nullable();
            $table->integer('ac_user_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->enum('is_ewa', ['yes', 'no'])->default('no')->index();
            $table->string('is_new')->default('new')->index();
            $table->enum('is_sibling', ['yes', 'no'])->default('no')->index();
            $table->enum('status', ['active', 'inactive'])->default('active')->index();
            $table->date('inactive_date')->nullable();
            $table->string('father_photo')->default('assets/images/user_no_image.png');
            $table->string('mother_photo')->default('assets/images/user_no_image.png');
            $table->string('local_guardian_photo')->default('assets/images/user_no_image.png');
            $table->string('profile_img')->default('assets/images/user_no_image.png');
            $table->string('username')->nullable();
            $table->string('pwd')->nullable();
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
        Schema::dropIfExists('student_admission_class_record');
    }
}
