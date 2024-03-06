<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDynamicReportSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dynamic_report_setting', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_id');
            $table->unsignedInteger('branches_id');
            $table->string('page_name');
            $table->string('report_name')->nullable();
            $table->string('report_url')->nullable();
            $table->string('report_title')->nullable();
            $table->string('orientation');
            $table->string('page_layout');
            $table->string('layout_font_size')->nullable();
            $table->string('layout_text_color')->nullable();
            $table->text('watermark')->nullable();
            $table->enum('is_header', ['yes', 'no'])->default('no')->index();
            $table->enum('is_header_line', ['yes', 'no'])->default('no')->index();
            $table->enum('is_footer', ['yes', 'no'])->default('no')->index();
            $table->enum('is_footer_line', ['yes', 'no'])->default('no')->index();
            $table->enum('is_logo', ['yes', 'no'])->default('no')->index();
            $table->string('logo_height')->nullable();
            $table->enum('is_row', ['yes', 'no'])->default('no')->index();
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
            $table->string('watermark_file')->default('assets/images/no-image-available.png');
            $table->longText('stylesheet')->nullable();
            $table->longText('footer_body')->nullable();
            $table->string('f_font_size')->nullable();
            $table->string('f_align')->nullable();
            $table->string('bg_color')->nullable();
            $table->string('text_color')->nullable();
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
        Schema::dropIfExists('dynamic_report_setting');
    }
}
