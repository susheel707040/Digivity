<?php

namespace App\Http\Requests\MasterAdmin\AcademicSetting;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
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
            'subject_name'=>['required'],
            'subject_code'=>['sometimes'],
            'priority'=>['required'],
            'status'=>['required']
        ];
    }
}
