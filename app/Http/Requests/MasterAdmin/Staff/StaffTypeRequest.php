<?php

namespace App\Http\Requests\MasterAdmin\Staff;

use Illuminate\Foundation\Http\FormRequest;

class StaffTypeRequest extends FormRequest
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
            'staff_type'=>['required'],
            'is_hourly_paid'=>['sometimes'],
            'show_on_erp'=>['sometimes'],
            'default_at'=>['sometimes']
        ];
    }
}
