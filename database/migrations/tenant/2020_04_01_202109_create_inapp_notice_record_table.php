<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInappNoticeRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inapp_notice_record', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_id');
            $table->unsignedInteger('branches_id');
            $table->unsignedInteger('academic_id');
            $table->enum('type',['all','student','staff'])->default('all');
            $table->unsignedInteger('course_id')->nullable();
            $table->unsignedInteger('section_id')->nullable();
            $table->unsignedInteger('department_id')->nullable();
            $table->unsignedInteger('designation_id')->nullable();
            $table->unsignedInteger('student_id')->nullable();
            $table->unsignedInteger('staff_id')->nullable();
            $table->date('notice_date');
            $table->text('notice_title')->nullable();
            $table->longText('notice')->nullable();
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
        Schema::dropIfExists('inapp_notice_record');
    }
}
