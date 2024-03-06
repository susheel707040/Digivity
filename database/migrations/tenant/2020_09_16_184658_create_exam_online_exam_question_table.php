<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamOnlineExamQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_online_exam_question', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_id');
            $table->unsignedInteger('branches_id');
            $table->unsignedInteger('academic_id');
            $table->unsignedInteger('exam_id');
            $table->unsignedInteger('course_id');
            $table->unsignedInteger('section_id')->nullable();
            $table->unsignedInteger('question_title_id')->nullable();
            $table->longText('question');
            $table->decimal('marks')->default(0);
            $table->enum('question_type',['objective','match_tree','text_answer','text_answer_with_file'])->default('objective');
            $table->longText('question_input');
            $table->longText('file')->nullable();
            $table->enum('is_active',[0,1])->default(0);
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
        Schema::dropIfExists('exam_online_exam_question');
    }
}
