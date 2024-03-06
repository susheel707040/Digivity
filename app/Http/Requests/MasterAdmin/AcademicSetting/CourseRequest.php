<?php

namespace App\Http\Requests\MasterAdmin\AcademicSetting;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            "wing_id"=>['sometimes'],
            "sequence"=>['required'],
            "course"=>['required'],
            "course_code"=>['sometimes'],
            "full_name"=>['sometimes'],
            "tc_name"=>['sometimes'],
        ];
    }
}
