<?php

namespace App\Http\Requests\MasterAdmin\MarksManager\OnlineExam\OnlineExamSetting;

use Illuminate\Foundation\Http\FormRequest;

class OnlineExamQuestionCategoryRequest extends FormRequest
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
            'exam_id'=>['required'],
            'question_category'=>['required'],
            'default'=>['required']
        ];
    }
}
