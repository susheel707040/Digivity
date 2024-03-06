<?php

namespace App\Http\Requests\MasterAdmin\User;

use Illuminate\Foundation\Http\FormRequest;

class UserPermissionRequest extends FormRequest
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
            'ac_user_id'=>['required'],
            'web_app_module'=>['required']
        ];
    }
}
