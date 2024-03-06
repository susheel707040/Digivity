<?php

namespace App\Http\Requests\MasterAdmin\MarksManager;

use Illuminate\Foundation\Http\FormRequest;

class ExamSubjectMapCourseRequest extends FormRequest
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
            'subject_id'=>['required']
        ];
    }
}
