<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificateRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificate_record', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_id');
            $table->unsignedInteger('branches_id');
            $table->unsignedInteger('academic_id');
            $table->string('certificate_no')->nullable();
            $table->date('issue_date')->nullable();
            $table->unsignedInteger('student_id')->nullable();
            $table->unsignedInteger('staff_id')->nullable();
            $table->unsignedInteger('certificate_id');
            $table->string('certificate_for');
            $table->string('integrate')->nullable();
            $table->longText('request_data')->nullable();
            $table->longText('certificate_content')->nullable();
            $table->enum('status',['active','inactive'])->default('active');
            $table->boolean('update_times')->default(0);
            $table->boolean('print_times')->default(0);
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
        Schema::dropIfExists('certificate_record');
    }
}
