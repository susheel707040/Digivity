<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceFeeReceiptSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_fee_receipt_setting', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_id');
            $table->unsignedInteger('branches_id');
            $table->unsignedInteger('financial_id');
            $table->string('config_for');
            $table->string('rec_format');
            $table->boolean('rec_copy_qty');
            $table->string('rec_title');
            $table->text('rec_hard_copy')->nullable();
            $table->string('rec_font_size')->nullable();
            $table->string('apply_rec_copy_no')->nullable();
            $table->enum('concession_amt_show',['yes','no'])->default('no');
            $table->enum('late_amt_show',['yes','no'])->default('no');
            $table->enum('paid_amt_show',['yes','no'])->default('no');
            $table->enum('bal_amt_show',['yes','no'])->default('no');
            $table->enum('is_header', ['yes', 'no'])->default('no')->index();
            $table->enum('is_header_line', ['yes', 'no'])->default('no')->index();
            $table->enum('is_footer', ['yes', 'no'])->default('no')->index();
            $table->enum('is_footer_line', ['yes', 'no'])->default('no')->index();
            $table->enum('is_logo', ['yes', 'no'])->default('no')->index();
            $table->string('logo_height')->nullable();
            $table->text('school_name');
            $table->string('s_font_size')->nullable();
            $table->string('s_font_weight')->nullable();
            $table->string('s_font_family')->nullable();
            $table->string('s_text_align')->nullable();
            $table->string('s_color')->nullable();
            $table->string('s_padding')->nullable();
            $table->string('s_margin')->nullable();
            $table->string('s_define_class')->nullable();
            $table->longText('school_middle_body')->nullable();
            $table->string('sm_font_size')->nullable();
            $table->string('sm_font_weight')->nullable();
            $table->string('sm_font_family')->nullable();
            $table->string('sm_text_align')->nullable();
            $table->string('sm_color')->nullable();
            $table->string('sm_padding')->nullable();
            $table->string('sm_margin')->nullable();
            $table->string('sm_define_class')->nullable();
            $table->string('school_logo')->default('assets/images/no-image-available.png');
            $table->string('watermark_logo')->default('assets/images/no-image-available.png');
            $table->longText('stylesheet')->nullable();
            $table->enum('clb_school',['yes','no'])->default('no');
            $table->string('course_id')->nullable();
            $table->text('clb_school_name')->nullable();
            $table->string('clb_s_font_size')->nullable();
            $table->string('clb_s_font_weight')->nullable();
            $table->string('clb_s_font_family')->nullable();
            $table->string('clb_s_text_align')->nullable();
            $table->string('clb_s_color')->nullable();
            $table->string('clb_s_padding')->nullable();
            $table->string('clb_s_margin')->nullable();
            $table->string('clb_s_define_class')->nullable();
            $table->longText('clb_school_middle_body')->nullable();
            $table->string('clb_sm_font_size')->nullable();
            $table->string('clb_sm_font_weight')->nullable();
            $table->string('clb_sm_font_family')->nullable();
            $table->string('clb_sm_text_align')->nullable();
            $table->string('clb_sm_color')->nullable();
            $table->string('clb_sm_padding')->nullable();
            $table->string('clb_sm_margin')->nullable();
            $table->string('clb_sm_define_class')->nullable();
            $table->string('clb_school_logo')->default('assets/images/no-image-available.png');
            $table->string('clb_watermark_logo')->default('assets/images/no-image-available.png');
            $table->longText('clb_stylesheet')->nullable();
            $table->longText('footer_body')->nullable();
            $table->string('f_font_size')->nullable();
            $table->string('f_align')->nullable();
            $table->string('bg_color')->nullable();
            $table->string('text_color')->nullable();
            $table->longText('receipt_note')->nullable();
            $table->longText('header_addon')->nullable();
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
        Schema::dropIfExists('finance_fee_receipt_setting');
    }
}
