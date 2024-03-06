<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInappHomeworkAttachmentFileRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inapp_homework_attachment_file_record', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('homework_id');
            $table->text('file_name')->nullable();
            $table->longText('attachment_files')->nullable();
            $table->string('extension')->nullable();
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
        Schema::dropIfExists('inapp_homework_attachment_file_record');
    }
}
