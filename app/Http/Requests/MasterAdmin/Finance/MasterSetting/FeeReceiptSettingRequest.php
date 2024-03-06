<?php

namespace App\Http\Requests\MasterAdmin\Finance\MasterSetting;

use Illuminate\Foundation\Http\FormRequest;

class FeeReceiptSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'config_for' => ['required'],
            'rec_format' => ['required'],
            'rec_copy_qty' => ['required'],
            'rec_title' => ['sometimes'],
            'rec_hard_copy' => ['sometimes'],
            'rec_font_size' => ['sometimes'],
            'apply_rec_copy_no' => ['sometimes'],
            'concession_amt_show' => ['sometimes'],
            'late_amt_show' => ['sometimes'],
            'paid_amt_show' => ['sometimes'],
            'bal_amt_show' => ['sometimes'],
            'is_header' => ['sometimes'],
            'is_header_line' => ['sometimes'],
            'is_footer' => ['sometimes'],
            'is_footer_line' => ['sometimes'],
            'is_logo' => ['sometimes'],
            'logo_height' => ['sometimes'],
            'school_name' => ['sometimes'],
            's_font_size' => ['sometimes'],
            's_font_weight' => ['sometimes'],
            's_font_family' => ['sometimes'],
            's_text_align' => ['sometimes'],
            's_color' => ['sometimes'],
            's_padding' => ['sometimes'],
            's_margin' => ['sometimes'],
            's_define_class' => ['sometimes'],
            'school_middle_body' => ['sometimes'],
            'sm_font_size' => ['sometimes'],
            'sm_font_weight' => ['sometimes'],
            'sm_font_family' => ['sometimes'],
            'sm_text_align' => ['sometimes'],
            'sm_color' => ['sometimes'],
            'sm_padding' => ['sometimes'],
            'sm_margin' => ['sometimes'],
            'sm_define_class' => ['sometimes'],
            'school_logo' => ['sometimes'],
            'watermark_logo' => ['sometimes'],
            'stylesheet' => ['sometimes'],
            'clb_school' => ['sometimes'],
            'course_id' => ['sometimes'],
            'clb_school_name' => ['sometimes'],
            'clb_s_font_size' => ['sometimes'],
            'clb_s_font_weight' => ['sometimes'],
            'clb_s_font_family' => ['sometimes'],
            'clb_s_text_align' => ['sometimes'],
            'clb_s_color' => ['sometimes'],
            'clb_s_padding' => ['sometimes'],
            'clb_s_margin' => ['sometimes'],
            'clb_s_define_class' => ['sometimes'],
            'clb_school_middle_body' => ['sometimes'],
            'clb_sm_font_size' => ['sometimes'],
            'clb_sm_font_weight' => ['sometimes'],
            'clb_sm_font_family' => ['sometimes'],
            'clb_sm_text_align' => ['sometimes'],
            'clb_sm_color' => ['sometimes'],
            'clb_sm_padding' => ['sometimes'],
            'clb_sm_margin' => ['sometimes'],
            'clb_sm_define_class' => ['sometimes'],
            'clb_school_logo' => ['sometimes'],
            'clb_watermark_logo' => ['sometimes'],
            'clb_stylesheet' => ['sometimes'],
            'footer_body' => ['sometimes'],
            'f_font_size' => ['sometimes'],
            'f_align' => ['sometimes'],
            'bg_color' => ['sometimes'],
            'text_color' => ['sometimes'],
            'receipt_note' => ['sometimes'],
            'header_addon' => ['sometimes']
        ];
    }
}
