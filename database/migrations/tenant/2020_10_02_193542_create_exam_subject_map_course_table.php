<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamSubjectMapCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_subject_map_with_course', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_id');
            $table->unsignedInteger('branches_id');
            $table->unsignedInteger('academic_id');
            $table->unsignedInteger('course_id');
            $table->unsignedInteger('section_id');
            $table->boolean('position')->default(1);
            $table->unsignedInteger('subject_id');
            $table->unsignedInteger('skill_group_id')->nullable();
            $table->unsignedInteger('skill_id')->nullable();
            $table->boolean('skill_position')->default(0);
            $table->enum('marking_type',['m','g'])->default('m');
            $table->enum('subject_applicable',['1','0'])->default('1');
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
        Schema::dropIfExists('exam_subject_map_with_course');
    }
}
