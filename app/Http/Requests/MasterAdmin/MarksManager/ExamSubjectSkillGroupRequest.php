<?php

namespace App\Http\Requests\MasterAdmin\MarksManager;

use Illuminate\Foundation\Http\FormRequest;

class ExamSubjectSkillGroupRequest extends FormRequest
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
            'position'=>['required'],
            'skill_group_name'=>['required'],
            'description'=>['sometimes'],
            'print'=>['required'],
            'is_active'=>['required']
        ];
    }
}
