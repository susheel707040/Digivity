<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunicationNotificationRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communication_notification_record', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_id');
            $table->unsignedInteger('branches_id');
            $table->unsignedInteger('academic_id');
            $table->longText('communication_token_id');
            $table->string('platform')->nullable();
            $table->date('communication_date');
            $table->unsignedInteger('communication_type_id')->nullable();
            $table->string('sent_to')->nullable();
            $table->unsignedInteger('sent_to_id')->nullable();
            $table->string('contact_no');
            $table->boolean('total_receiver')->default(0);
            $table->string('unicode')->nullable();
            $table->longText('text_message');
            $table->decimal('sms_count')->default(0);
            $table->decimal('sms_balance')->default(0);
            $table->enum('delivery_status',['yes','no'])->default('no');
            $table->text('campaign_name')->nullable();
            $table->enum('phone_text',['yes','no'])->default('yes');
            $table->enum('mobile_app',['yes','no'])->default('yes');
            $table->enum('website',['yes','no'])->default('yes');
            $table->date('schedule_date')->nullable();
            $table->timestamp('schedule_date_time')->nullable();
            $table->enum('schedule_status',['yes','no'])->default('no');
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
        Schema::dropIfExists('communication_notification_record');
    }
}
