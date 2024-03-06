<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInappCalendarRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inapp_calendar_record', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_id');
            $table->unsignedInteger('branches_id');
            $table->unsignedInteger('calendar_type_id');
            $table->enum('type',['all','student','staff'])->default('all');
            $table->enum('reminder_text_sms',['yes','no'])->default('no');
            $table->enum('reminder_email',['yes','no'])->default('no');
            $table->enum('reminder_app',['yes','no'])->default('no');
            $table->date('start_date');
            $table->time('start_time')->nullable();
            $table->timestamp('start_date_time')->nullable();
            $table->date('end_date');
            $table->time('end_time')->nullable();
            $table->timestamp('end_date_time')->nullable();
            $table->text('calendar_title');
            $table->longText('calendar_details')->nullable();
            $table->enum('show_app',['yes','no'])->default('no');
            $table->enum('show_website',['yes','no'])->default('no');
            $table->enum('status',['yes','no'])->default('no');
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
        Schema::dropIfExists('inapp_calendar_record');
    }
}
