<?php

namespace App\Http\Requests\MasterAdmin\MarksManager;

use Illuminate\Foundation\Http\FormRequest;

class ExamActivitiesRequest extends FormRequest
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
            'exam_type_id'=>['required'],
            'position'=>['required'],
            'exam_activity'=>['required'],
            'alias'=>['sometimes'],
            'display'=>['required'],
            'is_active'=>['required']
        ];
    }
}
