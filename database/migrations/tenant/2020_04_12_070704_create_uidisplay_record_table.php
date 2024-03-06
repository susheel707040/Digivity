<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUidisplayRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uidisplay_record', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_id');
            $table->unsignedInteger('branches_id');
            $table->string('master_body_background')->nullable();
            $table->string('master_body_font_size')->nullable();
            $table->string('search_section_background')->nullable();
            $table->string('action_button_section_background')->nullable();
            $table->string('header_background')->nullable();
            $table->string('header_font_size')->nullable();
            $table->string('header_dropdown_background')->nullable();
            $table->string('navbar_background')->nullable();
            $table->string('navbar_font_size')->nullable();
            $table->string('navbar_icon_color')->nullable();
            $table->string('navbar_dropdown_background')->nullable();
            $table->string('navbar_dropdown_list_border')->nullable();
            $table->string('navbar_dropdown_list_hover_background')->nullable();
            $table->string('navbar_dropdown_list_text_color')->nullable();
            $table->string('navbar_dropdown_list_hover_text_color')->nullable();
            $table->string('modal_background')->nullable();
            $table->string('modal_text_color')->nullable();
            $table->string('modal_header_font_size')->nullable();
            $table->string('modal_body_background')->nullable();
            $table->string('modal_footer_background')->nullable();
            $table->string('modal_footer_text_color')->nullable();
            $table->string('panel_header_background')->nullable();
            $table->string('panel_header_text_color')->nullable();
            $table->string('panel_header_font_size')->nullable();
            $table->string('panel_body_background')->nullable();
            $table->string('panel_border_color')->nullable();
            $table->string('table_background')->nullable();
            $table->string('table_font_size')->nullable();
            $table->string('table_thead_background')->nullable();
            $table->string('table_thead_text_color')->nullable();
            $table->string('table_tbody_background')->nullable();
            $table->string('table_tbody_text_color')->nullable();
            $table->string('table_tfoot_background')->nullable();
            $table->string('table_tfoot_text_color')->nullable();
            $table->enum('table_datatable',['yes','no'])->default('yes');
            $table->string('table_datatable_pagination')->nullable();
            $table->string('table_border')->nullable();
            $table->longText('custom_stylesheet')->nullable();
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
        Schema::dropIfExists('uidisplay_record');
    }
}
