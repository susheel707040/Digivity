<?php

namespace App\Http\Requests\MasterAdmin\InApp;

use Illuminate\Foundation\Http\FormRequest;

class HomeworkRequest extends FormRequest
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
            'course_id'=>['required'],
            'section_id'=>['required'],
            'subject_id'=>['sometimes'],
            'hw_date'=>['required'],
            'hw_title'=>['sometimes'],
            'homework'=>['sometimes'],
            'with_app'=>['sometimes'],
            'with_text_sms'=>['sometimes'],
            'with_email'=>['sometimes'],
            'with_website'=>['sometimes'],
            'status'=>['sometimes']
        ];
    }
}
