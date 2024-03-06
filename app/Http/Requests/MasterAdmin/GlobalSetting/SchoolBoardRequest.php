<?php

namespace App\Http\Requests\MasterAdmin\GlobalSetting;

use Illuminate\Foundation\Http\FormRequest;

class SchoolBoardRequest extends FormRequest
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
            'school_id'=>['sometimes'],
            'branches_id'=>['sometimes'],
            'board_name' => ['required'],
            'default_at' => ['sometimes'],
            'deleted_at' => ['sometimes'],
        ];
    }
}
