<?php

namespace App\Http\Requests\MasterAdmin\Attendance;

use Illuminate\Foundation\Http\FormRequest;

class LeaveTypeRequest extends FormRequest
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
            'sequence'=>['sometimes'],
            'leave_type'=>['required'],
            'alias'=>['sometimes'],
            'description'=>['sometimes']
        ];
    }
}
