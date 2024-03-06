<?php

namespace App\Http\Requests\MasterAdmin\Staff;

use Illuminate\Foundation\Http\FormRequest;

class StaffDesignationRequest extends FormRequest
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
            'designation'=>['required'],
            'show_in_payroll'=>['sometimes'],
            'default_at'=>['sometimes']
        ];
    }
}
