<?php

namespace App\Models\MasterAdmin\GlobalSetting;

use App\Models\Record;

class UIDisplay extends Record
{
    protected $table = "uidisplay_record";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'master_body_background',
        'master_body_font_size',
        'search_section_background',
        'action_button_section_background',
        'header_background',
        'header_font_size',
        'header_dropdown_background',
        'navbar_background',
        'navbar_font_size',
        'navbar_icon_color',
        'navbar_dropdown_background',
        'navbar_dropdown_list_border',
        'navbar_dropdown_list_hover_background',
        'navbar_dropdown_list_text_color',
        'navbar_dropdown_list_hover_text_color',
        'modal_background',
        'modal_text_color',
        'modal_header_font_size',
        'modal_body_background',
        'modal_footer_background',
        'modal_footer_background',
        'modal_footer_text_color',
        'panel_header_background',
        'panel_header_text_color',
        'panel_header_font_size',
        'panel_body_background',
        'panel_border_color',
        'table_background',
        'table_font_size',
        'table_thead_background',
        'table_thead_text_color',
        'table_tbody_background',
        'table_tbody_text_color',
        'table_tfoot_background',
        'table_tfoot_text_color',
        'table_datatable',
        'table_datatable_pagination',
        'table_border',
        'custom_stylesheet',
        'user_id'
    ];
}
