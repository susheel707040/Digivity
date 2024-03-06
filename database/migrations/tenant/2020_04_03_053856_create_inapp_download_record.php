<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInappDownloadRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inapp_download_record', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_id');
            $table->unsignedInteger('branches_id');
            $table->unsignedInteger('academic_id');
            $table->enum('type',['all','student','staff'])->default('student');
            $table->unsignedInteger('course_id')->nullable();
            $table->unsignedInteger('section_id')->nullable();
            $table->unsignedInteger('student_id')->nullable();
            $table->unsignedInteger('department_id')->nullable();
            $table->unsignedInteger('designation_id')->nullable();
            $table->unsignedInteger('staff_id')->nullable();
            $table->date('upload_date');
            $table->text('download_title');
            $table->longText('download_details')->nullable();
            $table->text('file_name')->nullable();
            $table->string('extension')->nullable();
            $table->longText('file_path')->nullable();
            $table->enum('show_app',['yes','no'])->default('no');
            $table->enum('show_website',['yes','no'])->default('no');
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
        Schema::dropIfExists('inapp_download_record');
    }
}
