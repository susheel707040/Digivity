<?php

namespace App\Http\Requests\MasterAdmin\Transport\MasterSetting;

use Illuminate\Foundation\Http\FormRequest;

class TravelAgencyRequest extends FormRequest
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
            'travel_agency'=>['required'],
            'person_name'=>['sometimes'],
            'mobile_no'=>['sometimes'],
            'email'=>['sometimes'],
            'office_address'=>['sometimes'],
            'user_id'=>['sometimes']
        ];
    }
}
