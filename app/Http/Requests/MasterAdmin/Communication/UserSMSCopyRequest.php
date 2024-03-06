<?php

namespace App\Http\Requests\MasterAdmin\Communication;

use Illuminate\Foundation\Http\FormRequest;

class UserSMSCopyRequest extends FormRequest
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
            'designation'=>['sometimes'],
            'name'=>['required'],
            'gender'=>['sometimes'],
            'mobile_no'=>['required'],
            'email_id'=>['sometimes'],
            'note'=>['sometimes'],
            'status'=>['required']
        ];
    }
}
