<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamMarksRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_marks_record', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_id');
            $table->unsignedInteger('branches_id');
            $table->unsignedInteger('academic_id');
            $table->unsignedInteger('course_id');
            $table->unsignedInteger('section_id');
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('exam_term_id');
            $table->unsignedInteger('exam_type_id');
            $table->enum('integrate',['none','subject','activities'])->default('subject');
            $table->unsignedInteger('exam_assessment_id');
            $table->unsignedInteger('subject_id');
            $table->unsignedInteger('skill_id')->nullable();
            $table->longText('remark')->nullable();
            $table->string('marks')->nullable();
            $table->enum('marking_type',['m','g'])->default('m');
            $table->string('attend_status')->nullable();
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
        Schema::dropIfExists('exam_marks_record');
    }
}
