<?php

namespace App\Http\Requests\MasterAdmin\InApp;

use Illuminate\Foundation\Http\FormRequest;

class CalendarRequest extends FormRequest
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
            'calendar_type_id' => ['required'],
            'type' => ['required'],
            'reminder_text_sms' => ['sometimes'],
            'reminder_email' => ['sometimes'],
            'reminder_app' => ['sometimes'],
            'start_date' => ['required'],
            'start_time' => ['sometimes'],
            'end_date' => ['required'],
            'end_time' => ['sometimes'],
            'calendar_title' => ['required'],
            'calendar_details' => ['sometimes'],
            'show_app' => ['sometimes'],
            'show_website' => ['sometimes'],
            'status' => ['required']
        ];
    }
}
