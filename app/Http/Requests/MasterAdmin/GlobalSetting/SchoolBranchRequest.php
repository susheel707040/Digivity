<?php

namespace App\Http\Requests\MasterAdmin\GlobalSetting;

use Illuminate\Foundation\Http\FormRequest;

class SchoolBranchRequest extends FormRequest
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
            'school_name'=>['required'],
            'color'=>['sometimes'],
            'address'=>['sometimes'],
            'ads_color'=>['sometimes'],
            'about'=>['sometimes'],
            'contact_no'=>['sometimes'],
            'email'=>['sometimes'],
            'logo'=>['sometimes'],
            'banner_logo'=>['sometimes'],
            'city'=>['sometimes'],
            'currency'=>['sometimes'],
            'language'=>['sometimes'],
            'timezone'=>['sometimes'],
            'location'=>['sometimes'],
            'latitude'=>['sometimes'],
            'longitude'=>['sometimes']
        ];
    }
}
