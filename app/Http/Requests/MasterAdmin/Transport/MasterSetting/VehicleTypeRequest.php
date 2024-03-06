<?php

namespace App\Http\Requests\MasterAdmin\Transport\MasterSetting;

use Illuminate\Foundation\Http\FormRequest;

class VehicleTypeRequest extends FormRequest
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
            'vehicle_type'=>['required'],
            'default_at'=>['sometimes']
        ];
    }
}
