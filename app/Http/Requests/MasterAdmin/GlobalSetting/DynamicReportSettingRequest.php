<?php

namespace App\Http\Requests\MasterAdmin\GlobalSetting;

use Illuminate\Foundation\Http\FormRequest;

class DynamicReportSettingRequest extends FormRequest
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
            'page_name'=>['required'],
            'report_name'=>['required'],
            'report_url'=>['sometimes'],
            'report_title'=>['sometimes'],
            'orientation'=>['required'],
            'page_layout'=>['required'],
            'layout_font_size'=>['sometimes'],
            'layout_text_color'=>['sometimes'],
            'watermark_file'=>['sometimes'],
            'is_header'=>['sometimes'],
            'is_header_line'=>['sometimes'],
            'is_footer'=>['sometimes'],
            'is_footer_line'=>['sometimes'],
            'is_logo'=>['sometimes'],
            'logo_height'=>['sometimes'],
            'is_row'=>['sometimes'],
            'school_name'=>['required'],
            's_font_size'=>['sometimes'],
            's_font-weight'=>['sometimes'],
            's_font_family'=>['sometimes'],
            's_text_align'=>['sometimes'],
            's_color'=>['sometimes'],
            's_padding'=>['sometimes'],
            's_margin'=>['sometimes'],
            's_define_class'=>['sometimes'],
            'school_middle_body'=>['sometimes'],
            'sm_font_size'=>['sometimes'],
            'sm_font_weight'=>['sometimes'],
            'sm_font_family'=>['sometimes'],
            'sm_text_align'=>['sometimes'],
            'sm_color'=>['sometimes'],
            'sm_padding'=>['sometimes'],
            'sm_margin'=>['sometimes'],
            'sm_define_class'=>['sometimes'],
            'school_logo_file'=>['sometimes'],
            'stylesheet'=>['sometimes'],
            'footer_body'=>['sometimes'],
            'f_font_size'=>['sometimes'],
            'f_align'=>['sometimes'],
            'bg_color'=>['sometimes'],
            'text_color'=>['sometimes']
        ];
    }
}
