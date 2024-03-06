<?php

namespace App\Http\Requests\MasterAdmin\Communication;

use Illuminate\Foundation\Http\FormRequest;

class EmailTemplateRequest extends FormRequest
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
            'template_name'=>['required'],
            'subject'=>['sometimes'],
            'sms_type'=>['sometimes'],
            'template'=>['required'],
            'is_active'=>['required']
        ];
    }
}
