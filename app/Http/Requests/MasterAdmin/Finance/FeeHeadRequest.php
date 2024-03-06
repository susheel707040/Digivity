<?php

namespace App\Http\Requests\MasterAdmin\Finance;

use Illuminate\Foundation\Http\FormRequest;

class FeeHeadRequest extends FormRequest
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
            'fee_head'=>['required'],
            'print_line_one'=>['sometimes'],
            'print_line_two'=>['sometimes'],
            'type'=>['sometimes'],
            'refund'=>['required'],
            'apply'=>['required'],
            'priority'=>['required'],
            'fee_custom'=>['required'],
            'form_sale'=>['required']
        ];
    }
}