<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SchoolRequest extends FormRequest
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
            'school_name' => ['required'],
            'school_no' => ['sometimes'],
            'affiliation_to' => ['sometimes'],
            'school_short_name' => ['sometimes'],
            'affiliation_no' => ['sometimes'],
            'associates' => ['sometimes'],
            'trust_society_name' => ['sometimes'],
            'trust_society_no' => ['sometimes'],
            'contact_number' => ['required'],
            'email_address' => ['required'],
            'support_email' => ['sometimes'],
            'website' => ['sometimes'],
            'address1' => ['sometimes'],
            'address2' => ['sometimes'],
            'establishment_year' => ['sometimes'],
            'establishment_code' => ['sometimes'],
            'chairman' => ['sometimes'],
            'iso_details' => ['sometimes'],
            'working_days' => ['sometimes'],
            'school_logo' => ['required'],
            'otp' => ['sometimes']
        ];
    }
}
