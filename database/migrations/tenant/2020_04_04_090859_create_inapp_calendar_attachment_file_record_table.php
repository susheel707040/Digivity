<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInappCalendarAttachmentFileRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inapp_calendar_attachment_file_record', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('calendar_id');
            $table->text('file_name')->nullable();
            $table->longText('file_path')->nullable();
            $table->string('extension')->nullable();
            $table->unsignedInteger('user_id');
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
        Schema::dropIfExists('inapp_calendar_attachment_file_record');
    }
}
