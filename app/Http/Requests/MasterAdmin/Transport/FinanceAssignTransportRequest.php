<?php

namespace App\Http\Requests\MasterAdmin\Transport;

use Illuminate\Foundation\Http\FormRequest;

class FinanceAssignTransportRequest extends FormRequest
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
            'transport_start_date'=>['required'],
            'transport_id'=>['required'],
            'transport_stop_date'=>['sometimes']
        ];
    }
}
