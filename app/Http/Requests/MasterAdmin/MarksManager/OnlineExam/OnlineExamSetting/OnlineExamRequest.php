<?php

namespace App\Http\Requests\MasterAdmin\MarksManager\OnlineExam\OnlineExamSetting;

use Illuminate\Foundation\Http\FormRequest;

class OnlineExamRequest extends FormRequest
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
            'exam_name'=>['required'],
            'exam_type'=>['required'],
            'start_date'=>['required'],
            'end_date'=>['required'],
            'duration'=>['required'],
            'subject_id'=>['sometimes'],
            'pass_marks'=>['required'],
            'exam_format'=>['required']
        ];
    }
}
