<?php

namespace App\Http\Requests\MasterAdmin\GlobalSetting;

use Illuminate\Foundation\Http\FormRequest;

class UserMapModuleRequest extends FormRequest
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
            'role_id'=>['required'],
            'web_app_module'=>['required'],
            'mobile_app_module'=>['required']
        ];
    }
}
