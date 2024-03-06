<?php

namespace App\Http\Requests\MasterAdmin\MarksManager;

use Illuminate\Foundation\Http\FormRequest;

class ExamTermRequest extends FormRequest
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
            'position' => ['required'],
            'exam_term' => ['required'],
            'alias' => ['sometimes'],
            'description' => ['sometimes'],
            'is_active' => ['required']
        ];
    }
}
