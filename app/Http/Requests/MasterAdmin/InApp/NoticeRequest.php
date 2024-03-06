<?php

namespace App\Http\Requests\MasterAdmin\InApp;

use Illuminate\Foundation\Http\FormRequest;

class NoticeRequest extends FormRequest
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
            'type'=>['required'],
            'notice_date'=>['required'],
            'notice_title'=>['required'],
            'notice'=>['required'],
            'show_date_time'=>['sometimes'],
            'end_date_time'=>['sometimes'],
            'with_app'=>['sometimes'],
            'with_text_sms'=>['sometimes'],
            'with_email'=>['sometimes'],
            'with_website'=>['sometimes'],
            'status'=>['sometimes']
        ];
    }
}
