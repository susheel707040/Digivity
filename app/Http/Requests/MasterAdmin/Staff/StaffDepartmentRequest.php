<?php

namespace App\Http\Requests\MasterAdmin\Staff;

use Illuminate\Foundation\Http\FormRequest;

class StaffDepartmentRequest extends FormRequest
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
            'department'=>['required'],
            'default_at'=>['sometimes']
        ];
    }
}
