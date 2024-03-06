<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibraryEntryRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('library_entry_record', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_id');
            $table->unsignedInteger('branches_id');
            $table->unsignedInteger('academic_id');
            $table->longText('entry_id')->nullable();
            $table->unsignedInteger('library_id')->nullable();
            $table->unsignedInteger('student_id')->nullable();
            $table->unsignedInteger('staff_id')->nullable();
            $table->unsignedInteger('library_account_id')->nullable();
            $table->unsignedInteger('book_id');
            $table->string('book_group_id')->nullable();
            $table->date('entry_date');
            $table->date('end_date');
            $table->enum('entry_status',['issue','renew','return','lost'])->default('issue');
            $table->boolean('entry_count');
            $table->longText('remark')->nullable();
            $table->enum('status',['1','0'])->default('1');
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
        Schema::dropIfExists('library_entry_record');
    }
}
