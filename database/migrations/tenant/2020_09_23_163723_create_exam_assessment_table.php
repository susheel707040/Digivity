<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamAssessmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_assessment', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_id');
            $table->unsignedInteger('branches_id');
            $table->unsignedInteger('academic_id');
            $table->unsignedInteger('exam_term_id');
            $table->boolean('position')->default(0);
            $table->string('exam_assessment');
            $table->string('alias')->nullable();
            $table->decimal('marks',10,2)->default(0);
            $table->longText('description')->nullable();
            $table->enum('is_active',['0','1'])->default('0');
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
        Schema::dropIfExists('exam_assessment');
    }
}
