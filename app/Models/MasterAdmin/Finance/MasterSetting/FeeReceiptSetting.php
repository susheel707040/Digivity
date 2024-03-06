<?php

namespace App\Models\MasterAdmin\Finance\MasterSetting;

use App\Models\Record;

class FeeReceiptSetting extends Record
{
    protected $table = "finance_fee_receipt_setting";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'financial_id',
        'config_for',
        'rec_format',
        'rec_copy_qty',
        'rec_title',
        'rec_hard_copy',
        'rec_font_size',
        'apply_rec_copy_no',
        'concession_amt_show',
        'late_amt_show',
        'paid_amt_show',
        'bal_amt_show',
        'is_header',
        'is_header_line',
        'is_footer',
        'is_footer_line',
        'is_logo',
        'logo_height',
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
        'watermark_logo',
        'stylesheet',
        'clb_school',
        'course_id',
        'clb_school_name',
        'clb_s_font_size',
        'clb_s_font_weight',
        'clb_s_font_family',
        'clb_s_text_align',
        'clb_s_color',
        'clb_s_padding',
        'clb_s_margin',
        'clb_s_define_class',
        'clb_school_middle_body',
        'clb_sm_font_size',
        'clb_sm_font_weight',
        'clb_sm_font_family',
        'clb_sm_text_align',
        'clb_sm_color',
        'clb_sm_padding',
        'clb_sm_margin',
        'clb_sm_define_class',
        'clb_school_logo',
        'clb_watermark_logo',
        'clb_stylesheet',
        'footer_body',
        'f_font_size',
        'f_align',
        'bg_color',
        'text_color',
        'receipt_note',
        'header_addon',
        'user_id'

    ];

    public function SchoolDetails()
    {
        return [
            'school_name' => $this->school_name,
            'font_size' => $this->s_font_size,
            'font_weight' => $this->s_font_weight,
            'font_family' => $this->s_font_family,
            'text_align' => $this->s_text_align,
            'color' => $this->s_color,
            'padding' => $this->s_padding,
            'margin' => $this->s_margin,
            'define_class' => $this->s_define_class,
            'school_middle_body' => $this->school_middle_body,
            'sm_font_size' => $this->sm_font_size,
            'sm_font_weight' => $this->sm_font_weight,
            'sm_font_family' => $this->sm_font_family,
            'sm_text_align' => $this->sm_text_align,
            'sm_color' => $this->sm_color,
            'sm_padding' => $this->sm_padding,
            'sm_margin' => $this->sm_margin,
            'sm_define_class' => $this->sm_define_class,
            'school_logo' => $this->school_logo,
            'watermark_logo' => $this->watermark_logo,
            'stylesheet' => $this->stylesheet
        ];
    }

    public function CollaborateSchoolDetails()
    {
        return [
            'school_name' => $this->clb_school_name,
            'font_size' => $this->clb_s_font_size,
            'font_weight' => $this->clb_s_font_weight,
            'font_family' => $this->clb_s_font_family,
            'text_align' => $this->clb_s_text_align,
            'color' => $this->clb_s_color,
            'padding' => $this->clb_s_padding,
            'margin' => $this->clb_s_margin,
            'define_class' => $this->clb_s_define_class,
            'school_middle_body' => $this->clb_school_middle_body,
            'sm_font_size' => $this->clb_sm_font_size,
            'sm_font_weight' => $this->clb_sm_font_weight,
            'sm_font_family' => $this->clb_sm_font_family,
            'sm_text_align' => $this->clb_sm_text_align,
            'sm_color' => $this->clb_sm_color,
            'sm_padding' => $this->clb_sm_padding,
            'sm_margin' => $this->clb_sm_margin,
            'sm_define_class' => $this->clb_sm_define_class,
            'school_logo' => $this->clb_school_logo,
            'watermark_logo' => $this->clb_watermark_logo,
            'stylesheet' => $this->clb_stylesheet
        ];
    }

}
