<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamConfigurationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_configuration', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_id');
            $table->unsignedInteger('branches_id');
            $table->unsignedInteger('academic_id');
            $table->unsignedInteger('course_id');
            $table->unsignedInteger('section_id');
            $table->unsignedInteger('exam_type_id');
            $table->unsignedInteger('exam_term_id');
            $table->unsignedInteger('exam_assessment_id');
            $table->decimal('marks')->default(0);
            $table->enum('integrate',['subject','activities'])->default('subject');
            $table->unsignedInteger('subject_id')->nullable();
            $table->unsignedInteger('activity_id')->nullable();
            $table->decimal('grace')->default(0);
            $table->enum('convert_to_grade',['yes','no'])->default('no');
            $table->enum('sum_in_total',['yes','no'])->default('yes');
            $table->unsignedInteger('grade_id');
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
        Schema::dropIfExists('exam_configuration');
    }
}
