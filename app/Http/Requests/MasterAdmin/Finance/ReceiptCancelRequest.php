<?php

namespace App\Http\Requests\MasterAdmin\Finance;

use Illuminate\Foundation\Http\FormRequest;

class ReceiptCancelRequest extends FormRequest
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
            'cancel_date'=>['required'],
            'receipt_status'=>['required'],
            'reason'=>['required'],
            'attach_file'=>['sometimes']
        ];
    }
}
