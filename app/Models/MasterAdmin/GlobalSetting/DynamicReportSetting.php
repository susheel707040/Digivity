<?php

namespace App\Models\MasterAdmin\GlobalSetting;

use App\Models\Record;

class DynamicReportSetting extends Record
{
    protected $table="dynamic_report_setting";
    protected $fillable=[
        'school_id',
        'branches_id',
        'page_name',
        'report_name',
        'report_url',
        'report_title',
        'orientation',
        'page_layout',
        'layout_font_size',
        'layout_text_color',
        'watermark',
        'is_header',
        'is_header_line',
        'is_footer',
        'is_footer_line',
        'is_logo',
        'logo_height',
        'is_row',
        'school_name',
        's_font_size',
        's_font_weight',
        's_font_family',
        's_text_align',
        's_color',
        's_padding',
        's_margin',
        's_define_class',
        'school_middle_body',
        'sm_font_size',
        'sm_font_weight',
        'sm_font_family',
        'sm_text_align',
        'sm_color',
        'sm_padding',
        'sm_margin',
        'sm_define_class',
        'school_logo',
        'watermark_file',
        'stylesheet',
        'footer_body',
        'f_font_size',
        'f_align',
        'bg_color',
        'text_color',
        'user_id'
    ];
}
