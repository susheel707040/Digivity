<?php

namespace App\Http\Requests\MasterAdmin\Attendance;

use Illuminate\Foundation\Http\FormRequest;

class HolidayRequest extends FormRequest
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
            'for_student'=>['required'],
            'for_staff'=>['required'],
            'holiday'=>['required'],
            'description'=>['sometimes'],
            'symbol'=>['required'],
            'holiday_from_date'=>['required'],
            'holiday_to_date'=>['required'],
        ];
    }
}
