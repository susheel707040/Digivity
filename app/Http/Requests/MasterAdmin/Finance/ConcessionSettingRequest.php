<?php

namespace App\Http\Requests\MasterAdmin\Finance;

use Illuminate\Foundation\Http\FormRequest;

class ConcessionSettingRequest extends FormRequest
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
            'concession_type_id'=>['required'],
            'fee_head_id'=>['required']
        ];
    }
}
