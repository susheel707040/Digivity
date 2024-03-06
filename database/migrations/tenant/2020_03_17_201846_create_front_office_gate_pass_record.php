<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrontOfficeGatePassRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('front_office_gate_pass_record', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_id');
            $table->unsignedInteger('branches_id');
            $table->unsignedInteger('academic_id');
            $table->unsignedInteger('gp_type_id')->nullable();
            $table->unsignedInteger('gate_id')->nullable();
            $table->unsignedInteger('student_id')->nullable();
            $table->unsignedInteger('staff_id')->nullable();
            $table->string('applicant_name')->nullable();
            $table->string('receiver_relation')->nullable();
            $table->string('receiver_name')->nullable();
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
        Schema::dropIfExists('front_office_gate_pass_record');
    }
}
