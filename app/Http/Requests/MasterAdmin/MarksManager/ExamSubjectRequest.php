<?php

namespace App\Http\Requests\MasterAdmin\MarksManager;

use Illuminate\Foundation\Http\FormRequest;

class ExamSubjectRequest extends FormRequest
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
            'group_id'=>['sometimes'],
            'subject_name'=>['required'],
            'alias'=>['sometimes'],
            'subject_code'=>['sometimes'],
            'description'=>['sometimes'],
            'integrate'=>['sometimes'],
            'is_active'=>['required'],
            'define'=>['sometimes']
        ];
    }
}
