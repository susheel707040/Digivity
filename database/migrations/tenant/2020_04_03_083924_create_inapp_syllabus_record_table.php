<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInappSyllabusRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inapp_syllabus_record', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_id');
            $table->unsignedInteger('branches_id');
            $table->unsignedInteger('academic_id');
            $table->boolean('priority');
            $table->unsignedInteger('course_id');
            $table->unsignedInteger('subject_id')->nullable();
            $table->text('syllabus_title')->nullable();
            $table->longText('syllabus_details')->nullable();
            $table->text('icon')->nullable();
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
        Schema::dropIfExists('inapp_syllabus_record');
    }
}
