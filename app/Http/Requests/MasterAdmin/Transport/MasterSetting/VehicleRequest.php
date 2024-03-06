<?php

namespace App\Http\Requests\MasterAdmin\Transport\MasterSetting;

use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest
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
            'vehicle_type_id' => ['required'],
            'vehicle_name' => ['required'],
            'registration_no' => ['required'],
            'registration_date' => ['required'],
            'no_of_seat' => ['sometimes'],
            'max_allow' => ['sometimes'],
            'mileage_km' => ['sometimes'],
            'fuel_type' => ['sometimes'],
            'owner_name' => ['sometimes'],
            'mobile_no' => ['sometimes'],
            'user_id' => ['sometimes']
        ];
    }
}
