<?php

namespace App\Http\Requests\MasterAdmin\InApp;

use Illuminate\Foundation\Http\FormRequest;

class SyllabusRequest extends FormRequest
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
            'course_id'=>['required'],
            'subject_id'=>['sometimes'],
            'syllabus_title'=>['required'],
            'syllabus_details'=>['sometimes'],
            'show_app'=>['sometimes'],
            'show_website'=>['sometimes'],
            'status'=>['sometimes']
        ];
    }
}
