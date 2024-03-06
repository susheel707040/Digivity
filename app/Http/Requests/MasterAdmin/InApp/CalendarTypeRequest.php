<?php

namespace App\Http\Requests\MasterAdmin\InApp;

use Illuminate\Foundation\Http\FormRequest;

class CalendarTypeRequest extends FormRequest
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
            'priority'=>['required'],
            'calendar_type'=>['required'],
            'color'=>['sometimes'],
            'status'=>['required']
        ];
    }
}
