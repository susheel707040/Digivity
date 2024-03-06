<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInappHomeworkRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inapp_homework_record', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_id');
            $table->unsignedInteger('branches_id');
            $table->unsignedInteger('academic_id');
            $table->unsignedInteger('course_id');
            $table->unsignedInteger('section_id');
            $table->unsignedInteger('subject_id')->nullable();
            $table->date('hw_date');
            $table->text('hw_title')->nullable();
            $table->longText('homework')->nullable();
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
        Schema::dropIfExists('inapp_homework_record');
    }
}
