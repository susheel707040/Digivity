<?php

namespace App\Http\Requests\MasterAdmin\Finance;

use Illuminate\Foundation\Http\FormRequest;

class ReceiptModifyRequest extends FormRequest
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
            'old_receipt_record'=>['sometimes'],
            'modify_date'=>['sometimes'],
            'receipt_date'=>['sometimes'],
            'entry_mode'=>['sometimes'],
            'online_transaction_no'=>['sometimes'],
            'online_status'=>['sometimes'],
            'paymode_id'=>['required'],
            'instrument_no'=>['sometimes'],
            'instrument_date'=>['sometimes'],
            'bank'=>['sometimes'],
            'fee_remark'=>['sometimes'],
            'modify_reason'=>['required']
        ];
    }
}
