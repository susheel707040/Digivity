<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id')->unsigned()->nullable();
            $table->integer('branches_id')->unsigned()->nullable();
            $table->integer('academic_id')->unsigned()->nullable();
            $table->integer('financial_id')->unsigned()->nullable();
            $table->integer('role_id')->unsigned()->nullable();
            $table->integer('student_id')->unsigned()->nullable();
            $table->integer('staff_id')->unsigned()->nullable();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('email')->nullable();
            $table->string('profile_img')->default('assets/images/user_no_image.png')->nullable();
            $table->enum('two_fa_at', ['yes', 'no'])->default('no')->index();
            $table->enum('active_at', ['yes', 'no'])->default('yes')->index();
            $table->string('otp')->nullable()->index();
            $table->string('token')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
